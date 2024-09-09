<?php

namespace App\Http\Requests\Api\V1\SimCardGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSimCardGroupRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'groupName' => [
				'required',
				'string',
				'min:2',
				'max:50',
				Rule::unique('sim_card_groups', 'name') // Проверка уникальности имени в таблице sim_card_groups
			],
			'contract' => [
				'required',
				'integer',
				'min:1',
				Rule::exists('contracts', 'id')
			],
		];
	}
}
