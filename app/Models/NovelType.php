<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NovelType extends Model
{
    use HasFactory;

    public function novelTitle() {
        return $this->hasMany(NovelTitle::class);
    }
}
