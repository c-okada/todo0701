<?php

namespace App\Http\Controllers;

//フォルダを保存するためにの読込
use App\Folder;
// Requestクラスのインポート
use Illuminate\Http\Request;
// CreateFolderクラスのインポート
use App\Http\Requests\CreateFolder;
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
  //フォーム画面を返すルートを作成
  public function showCreateForm(){
    return view('folders/create');
  }
  
  // 引数にインポートしたRequestクラスを受け入れるが、CreateFoldeはRequestを継承しているため使用できる。
  public function create(CreateFolder $request){
    // フォルダモデルのインスタンスを作成する
    $folder = new Folder();
    // タイトルに入力値を代入する
    $folder->title = $request->title;

    //ユーザーに紐づけて保存する
    Auth::user()->folders()->save($folder);
    
    // インスタンスの状態をデータベースに書き込む、ユーザーの紐づけで全部保存しているので削除でOK
    // $folder->save();


    //リダイレクト処理(フォーム送信を行った後遷移するページ指定)
    return redirect()->route('tasks.index', [
        'id' => $folder->id,
    ]);
  }

}
