<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UpdateLog;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    private int $listMaxCnt = 20;

    /**
     * 更新履歴内容表示
     */
    public function index($updateLogId) {
        // 更新履歴取得
        $updateLog = UpdateLog::where('id', $updateLogId)
        ->get()
        ->first();

        return view('updateLog', [
            'updateLog' => $updateLog
        ]);
    }

    /**
     * 更新履歴一覧表示
     */
    public function list(Request $request) {
        // 項目取得
        $page = $request->input('page');
        $page = !empty($page) && !is_int($page) && 0 < $page ? $page : 0;

        // 更新履歴データを取得
        $updateLogs = UpdateLog::select(
            'id',
            'title',
            'created_at'
        )
        ->orderBy('created_at', 'desc')
        ->skip($this->listMaxCnt * ($page - 1))
        ->take($this->listMaxCnt)
        ->get();

        // ページネーション用データ取得
        $pager = UpdateLog::orderBy('created_at', 'desc')
        ->paginate($this->listMaxCnt);

        return view('updateLogList', [
            'updateLogs' => $updateLogs,
            'paginator' => $pager,
            'page' => $page
        ]);
    }
}
