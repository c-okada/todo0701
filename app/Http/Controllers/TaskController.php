<?php

namespace App\Http\Controllers;

use App\Folder;
//Taskを読み込むために宣言
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
// ★ Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //エラーハンドリングでオブジェクト型の引数を書き換える
    // public function index(int $id){
    public function index(Folder $folder){
                
        //ユーザーのフォルダを取得する
        $folders=Auth::user()->folders()->get();

        //全てのフォルダを取得する→ユーザーのみの取得に書き換える↑
        // $folders=Folder::all();
        

        //選ばれたフォルダから１行分データを取得する
        // $current_folder=Folder::find($id);
        //エラーハンドリング(すべてにabort表記しなくてはならないので、バインディング処理の方にする。そのため、findで探してくる上の行も要らなくなる)
        // if(is_null($current_folder)){
        //     abort(404);
        // }

        //選ばれたフォルダに紐づくタスクを取得する、Folderクラスにリレーションを記述すると短縮して記述できる。
        //$tasks = Task::where('folder_id', $current_folder->id)->get();
        // $tasks=$current_folder->tasks()->get();
        //バインディングさせる
        $tasks = $folder->tasks()->get();

        return view('tasks/index',[
            //全てのデータを各変数に格納させる
            'folders'=>$folders,
            //バインディングさせる'current_folder_id'=>$current_folder->id,
            'current_folder_id'=>$folder->id,
            'tasks'=>$tasks,
        ]);
    }

    //タスク作成フォームのルート作成
    public function showCreateForm(Folder $folder){
        return view('tasks/create',[
            'folder_id'=>$folder->id
        ]);
    }

    public function create(Folder $folder,CreateTask $request){
        //バインディングのため削除
        // $current_folder=Folder::find($id);

        $task=new Task();
        $task->title=$request->title;
        $task->due_date=$request->due_date;
        
        //current_folderに紐づくタスクを作成、リレーションを使用している。
        // $current_folder->tasks()->save($task);
        //バインディングのため書き換え
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index',[
            // 'id'=>$current_folder->id,
            //バインディングのため書き換え
            'folder'=>$folder->id,
        ]);
    }

    //タスク編集のルート作成
    // public function showEditForm(int $id,int $task_id){
    //バインディングのため書き換え
    public function showEditForm(Folder $folder,Task $task){
        //編集対象のタスクデータを取得する
        //バインディングのため削除
        // $task=Task::find($task_id);

        //テンプレートにデータを渡す
        return view('tasks/edit',[
            'task'=>$task,
        ]);
    }

    // public function edit(int $id,int $task_id,EditTask $request){
    //バインディングのため書き換え
    public function edit(Folder $folder,Task $task,EditTask $request){

        //リクエストされた ID でタスクデータを取得
        //バインディングのため削除
        // $task=Task::find($task_id);

        //編集対象のタスクデータに入力値を詰めて save
        DD($task);
        exit;
        $task->title=$request->title;
        $task->status=$request->status;
        $task->due_date=$request->due_date;
        $task->save();

        //編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index',[
            'folder'=>$task->folder_id,
        ]);
    }
}
