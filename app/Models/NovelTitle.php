<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NovelTitle extends Model
{
    use HasFactory, SoftDeletes;

    public function novelType() {
        return $this->belongsTo(NovelType::class);
    }

    /**
     * 小説を取得
     */
    public function novel() {
        return $this->hasMany(Novel::class);
    }
}
