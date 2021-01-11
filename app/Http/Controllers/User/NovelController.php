<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lock;
use App\Models\Novel;
use App\Models\NovelTitle;
use App\Models\NovelType;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NovelController extends Controller
{
    // ロック状態
    private $LOCK_STATUS = [
        'non' => 0,
        'lock' => 1,
        'release' => 2
    ];

    /**
     * 小説画面を表示
     */
    public function index(Request $request, $novelId) {
        return $this->returnNovelData($request, $novelId,false);
    }

    /**
     * ロック解除処理
     */
    public function cancelLock(Request $request, $novelId) {
        // パスワード取得
        $lock = Lock::select('password')
        ->join('novels', 'novels.lock_id', '=', 'locks.id')
        ->where('novels.id', $novelId)
        ->get()
        ->first();

        // パスワード比較
        if (!empty($request->input('password'))
            && $request->input('password') == $lock->password) {
            // 入力されたパスワードが正しい場合、ロック解除
            $request->session()->put(config('const.SESSION.CANCEL_KEY'), 'true');
            return $this->returnNovelData($request, $novelId, false);
        }
        else {
            // 入力されたパスワードが誤りの場合、ロック
            $request->session()->put(config('const.SESSION.CANCEL_KEY'), 'false');
            return $this->returnNovelData($request, $novelId, true);
        }
    }

    /**
     * 小説情報を返す
     */
    private function returnNovelData(Request $request, $novelId, $lockError) {
        // 該当小説情報取得
        $novel = Novel::with('lock')
        ->where('id', $novelId)
        ->get()
        ->first();

        // 小説が存在する場合
        $date = null;
        $pager = null;
        $novelType = null;
        $lockStatus = $this->LOCK_STATUS['non'];
        if (!empty($novel)) {
            // パンくずリスト用小説種別コード取得
            $type = NovelTitle::with('novelType')
            ->where('id', $novel->novel_title_id)
            ->get()
            ->first();
            $novelType = $type->novelType->type_code;

            // 日付成形
            $day = new DateTime($novel->created_at);
            $date = $day->format('Y/m/d');

            // ロックチェック
            $lockStatus = $this->LOCK_STATUS['release'];
            if (!empty($novel->lock)) {
                // 鍵付き対象小説の場合
                if ($request->session()->exists(config('const.SESSION.CANCEL_KEY'))
                    && $request->session()->get(config('const.SESSION.CANCEL_KEY')) == 'true') {
                    // ロック解除されている場合
                    $lockStatus = $this->LOCK_STATUS['release'];
                }
                else {
                    // ロック解除されていない場合
                    $lockStatus = $this->LOCK_STATUS['lock'];
                }
            }

            // ページ送りID取得
            $before_id = Novel::select('id')
            ->whereRaw('novel_title_id = parent.novel_title_id')
            ->whereRaw('id < parent.id')
            ->orderBy('order_id')
            ->limit(1)
            ->toSql();

            $after_id = Novel::select('id')
            ->whereRaw('novel_title_id = parent.novel_title_id')
            ->whereRaw('parent.id < id')
            ->orderBy('order_id')
            ->limit(1)
            ->toSql();

            $pager = DB::table('novels AS parent')
            ->selectRaw(
                "($before_id) AS before_id"
                .", id "
                .", ($after_id) AS after_id"
            )
            ->where('id', $novelId)
            ->get()
            ->first();
        }

        return view('novel', [
            'novelType' => $novelType,
            'novel' => $novel,
            'date' => $date,
            'lockStatus' => $lockStatus,
            'lockError' => $lockError,
            'pager' => $pager
        ]);
    }

    /**
     * 小説一覧ページ表示
     */
    public function list(Request $request) {
        // 小説種別取得
        $novelType = NovelType::select()
        ->whereExists(function($query) {
            $query->select(DB::raw('id'))
            ->from('novel_titles')
            ->whereRaw('novel_type_id = novel_types.id AND deleted_at IS NULL');
        })
        ->orderBy('order_id')
        ->get();

        // 小説タイプチェック
        $novelTypeId = $novelType[0]->id;
        $novelTypeCode = $novelType[0]->type_code;
        foreach ($novelType as $row) {
            if ($row->type_code == $request->input('novelTypeCode')) {
                $novelTypeId = $row->id;
                $novelTypeCode = $row->type_code;
                break;
            }
        }

        // 小説一覧取得
        $novelList = NovelTitle::select(
            'novel_titles.id AS title_id',
            'novel_titles.title AS novels_title',
            'novel_titles.description AS description',
            'novels.id AS novel_id',
            'novels.title AS novel_title',
            'novels.lock_id AS lock_id'
        )
        ->join('novels', 'novels.novel_title_id', '=', 'novel_titles.id')
        ->where('novel_titles.novel_type_id', $novelTypeId)
        ->orderBy('novel_titles.order_id')
        ->orderBy('novel_titles.id')
        ->orderBy('novels.order_id')
        ->get();

        return view('novelList', [
            'novelList' => $novelList,
            'novelType' => $novelType,
            'novelTypeCode' => $novelTypeCode
        ]);
    }
}
