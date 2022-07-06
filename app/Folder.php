<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //リレーション宣言
    public function tasks()
    {
        //フォルダテーブルとタスクテーブルの一対多の関連性を使用させる
        return $this->hasMany('App\Task');
    }
}
