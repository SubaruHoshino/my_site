<?php

namespace App\Http\Controllers;

use App\Models\UpdateLog;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private int $logCnt = 5;

    /**
     * インデックスページ表示
     */
    public function index() {
        // 更新履歴データを取得
        $updateLogs = UpdateLog::select(
            'id',
            'title',
            'created_at'
        )
        ->orderBy('created_at', 'desc')
        ->take($this->logCnt)
        ->get();

        return view('index', [
            'updateLogs' => $updateLogs
        ]);
    }
}
