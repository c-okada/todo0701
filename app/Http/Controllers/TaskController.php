<?php

namespace App\Http\Controllers;

use App\Folder;
//Taskを読み込むために宣言
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;

class TaskController extends Controller
{
    public function index(int $id){
        //全てのフォルダを取得する
        $folders=Folder::all();
        // dd($folders);
        // exit;

        //選ばれたフォルダから１行分データを取得する
        $current_folder=Folder::find($id);

        //選ばれたフォルダに紐づくタスクを取得する、Folderクラスにリレーションを記述すると短縮して記述できる。
        //$tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks=$current_folder->tasks()->get();

        return view('tasks/index',[
            //全てのデータを各変数に格納させる
            'folders'=>$folders,
            'current_folder_id'=>$current_folder->id,
            'tasks'=>$tasks,
        ]);
    }

    //タスク作成フォームのルート作成
    public function showCreateForm(int $id){
        return view('tasks/create',[
            'folder_id'=>$id
        ]);
    }

    public function create(int $id,CreateTask $request){
        $current_folder=Folder::find($id);

        $task=new Task();
        $task->title=$request->title;
        $task->due_date=$request->due_date;
        
        //current_folderに紐づくタスクを作成、リレーションを使用している。
        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index',[
            'id'=>$current_folder->id,
        ]);
    }

    //タスク編集のルート作成
    public function showEditForm(int $id,int $task_id){
        //編集対象のタスクデータを取得する
        $task=Task::find($task_id);

        //テンプレートにデータを渡す
        return view('tasks/edit',[
            'task'=>$task,
        ]);
    }

    public function edit(int $id,int $task_id,EditTask $request){
        //リクエストされた ID でタスクデータを取得
        $task=Task::find($task_id);

        //編集対象のタスクデータに入力値を詰めて save
        $task->title=$request->title;
        $task->status=$request->status;
        $task->due_date=$request->due_date;
        $task->save();

        //編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index',[
            'id'=>$task->folder_id,
        ]);
    }
}
