<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel extends Model
{
    use HasFactory, SoftDeletes;

    public function novelTitle() {
        return $this->belongsTo(NovelTitle::class);
    }

    public function lock() {
        return $this->belongsTo(Lock::class);
    }
}
