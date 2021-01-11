<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lock extends Model
{
    use HasFactory;

    public function novel() {
        return $this->hasMany(Novel::class);
    }
}
