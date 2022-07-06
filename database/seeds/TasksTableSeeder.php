<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1から3までのデータを作る
        foreach(range(1,3) as $num){
            DB::table('tasks')->insert([
                'folder_id'=>1,
                'title'=>"サンプルタスク{$num}",
                'status'=>$num,
                //Carbon ライブラリの addDay メソッドを利用して自動で日付を加算していく
                'due_date'=>Carbon::now()->addDay($num),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
