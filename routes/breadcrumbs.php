<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

/**
 * トップページ
 */
Breadcrumbs::for('index', function($trail) {
    $trail->push('トップ', route('index'));
});

/**
 * 更新履歴一覧
 */
Breadcrumbs::for('updateLogList', function($trail) {
    $trail->parent('index');
    $trail->push('更新履歴一覧', route('updateLogList'));
});

/**
 * 更新履歴
 */
Breadcrumbs::for('updateLog', function($trail, $data) {
    $trail->parent('updateLogList');
    $trail->push('更新履歴', route('updateLog', ['updateLogId' => $data->id]));
});

/**
 * はじめに
 */
Breadcrumbs::for('first', function($trail) {
    $trail->parent('index');
    $trail->push('はじめに', route('first'));
});

/**
 * 小説一覧
 */
Breadcrumbs::for('novelList', function($trail, $novelTypeCode) {
    $trail->parent('index');
    if (empty($novelTypeCode)) {
        $trail->push('小説一覧', route('novelList'));
    }
    else {
        $trail->push('小説一覧', route('novelList', ['novelTypeCode' => $novelTypeCode]));
    }
});

/**
 * 小説
 */
Breadcrumbs::for('novel', function($trail, $novelType, $novelId, $novelTitle) {
    $trail->parent('novelList', $novelType);
    $trail->push($novelTitle, route('novel', ['novelId', $novelId]));
});

/**
 * 外部リンク
 */
Breadcrumbs::for('link', function($trail) {
    $trail->parent('index');
    $trail->push('外部リンク', route('link'));
});
