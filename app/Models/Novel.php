<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 小説タイトルを取得
     */
    public function novelTitle() {
        return $this->belongsTo(NovelTitle::class);
    }
}
