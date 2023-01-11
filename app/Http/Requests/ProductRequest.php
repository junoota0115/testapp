<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'max:10000',
        ];
    }

    /**
 * 項目名
 *
 * @return array
 */
public function attributes()
{
    return [
        'product_name' => '商品名',
        'price' => '金額',
        'stock' => '在庫',
        'comment' => 'コメント'
    ];
}

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'price.required' => ':attributeは必須項目です',
            'stock.required' => ':attributeは必須項目です',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }


}
