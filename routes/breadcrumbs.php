<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

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
