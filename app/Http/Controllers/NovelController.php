<?php

namespace App\Http\Controllers;

use App\Models\NovelTitle;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function index() {

    }

    /**
     * 小説一覧ページ表示
     */
    public function list() {
        // 小説一覧取得
        $novelList = NovelTitle::select(
            'novel_titles.id AS title_id',
            'novel_titles.title AS novels_title',
            'novel_titles.description AS description',
            'novels.id AS novel_id',
            'novels.title AS novel_title'
        )
        ->join('novels', 'novel_titles.id', '=', 'novels.novel_title_id')
        ->orderBy('novel_titles.order_id')
        ->orderBy('novels.order_id')
        ->get();

        return view('novelList', [
            'list' => $novelList
        ]);
    }
}
