<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //今回はこの機能は使用しないので true を返す（つまりリクエストを受け付ける）
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //HTML側でのinput要素のname属性に対応します。キーに対する値の部分でルールを指定します。
            'title'=>'required|max:20',
        ];
    }

    public function attributes(){
        return[
            //返されるtitleをフォルダ名に変換している
            'title'=>'フォルダ名',
        ];
    }
}
