<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Authを読みこむ
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        //ログインユーザーを取得する
        $user=Auth::user();

        //ログインユーザーに紐づくフォルダーを１つ取得する
        $folder=$user->folders()->first();

        //まだ１つもフォルダを作っていなければホームをレスポンスする
        if (is_null($folder)){
            return view('home');
        }

        //フォルダがあればそのフォルダのタスク一覧にリダイレクトする
        return redirect()->route('tasks.index',[
            'id'=>$folder->id,
        ]);

    // //home画面へのルート,上記のブラッシュアップによりview('home')だけではなくなった
    // public function index()
    // {
    //     return view('home');
    // }
    }
}
