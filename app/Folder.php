<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//ソフトデリート
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    //ソフトデリート
    use SoftDeletes;

    //リレーション宣言
    public function tasks()
    {
        //フォルダテーブルとタスクテーブルの一対多の関連性を使用させる
        return $this->hasMany('App\Task');
    }
}
