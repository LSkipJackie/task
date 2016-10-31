<?php
namespace App\Modules\Manage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
	
	public function rules()
	{
		return [
				'title' => 'required|between:2,10|alpha_num',
			    'price' => 'required|price'
		];
	}

	
	public function authorize()
	{
		return true;
	}

	public function messages()
	{
		return [
				'title.required' => '请输入工具名称',
				'title.between' => '分类名称为:min - :max位',
				'price.required' => '请输入服务费用',
				'price.price' => '服务费用为正整数'
	    ];
	}
}
