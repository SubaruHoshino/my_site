<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\NovelTitle;
use App\Models\NovelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NovelController extends Controller
{
    /**
     * 小説画面を表示
     */
    public function index(Request $request, $novelId) {
        // 該当小説情報取得
        $novel = Novel::select()
        ->where('id', $novelId)
        ->get();

        if (!empty($novel)) {
            // 前ページのID取得
            // $prePageId = Novel::select('id')
        }

        return view('novel');
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
            'novels.title AS novel_title'
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
