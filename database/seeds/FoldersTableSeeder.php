<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //userを一行だけ取得する
        $user=DB::table('users')->first();

        //作りたいフォルダの名前を格納する
        $titles=['プライベート','仕事','旅行'];
        
        //フォルダ名に対してループ処理させる
        foreach($titles as $title){
            DB::table('folders')->insert([
                'title' => $title,
                //userテーブルから取得した行をuser_idに設定する
                'user_id'=>$user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
