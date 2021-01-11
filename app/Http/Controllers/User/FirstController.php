<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lock;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    /**
     * はじめに画面
     */
    public function index() {
        // パスワード取得
        $lock = Lock::select('password')
        ->where('id', 1)
        ->get()
        ->first();

        return view('first', [
            'password' => $lock->password
        ]);
    }
}
