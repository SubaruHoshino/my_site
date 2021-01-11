<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

use function PHPUnit\Framework\isNull;

Breadcrumbs::for('index', function($trail) {
    $trail->push('トップ', route('index'));
});

Breadcrumbs::for('updateLogList', function($trail) {
    $trail->parent('index');
    $trail->push('更新履歴一覧', route('updateLogList'));
});

Breadcrumbs::for('updateLog', function($trail, $data) {
    $trail->parent('updateLogList');
    $trail->push('更新履歴', route('updateLog', ['updateLogId' => $data->id]));
});

Breadcrumbs::for('novelList', function($trail, $novelTypeCode) {
    $trail->parent('index');
    if (empty($novelTypeCode)) {
        $trail->push('小説一覧', route('novelList'));
    }
    else {
        $trail->push('小説一覧', route('novelList', ['novelTypeCode' => $novelTypeCode]));
    }
});

Breadcrumbs::for('novel', function($trail, $novelType, $novelId, $novelTitle) {
    $trail->parent('novelList', $novelType);
    $trail->push($novelTitle, route('novel', ['novelId', $novelId]));
});
