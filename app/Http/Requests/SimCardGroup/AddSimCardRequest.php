<?php

namespace App\Http\Requests\SimCardGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddSimCardRequest extends FormRequest
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
			//"addedSimCard" => 'required|integer|min:1',
			"addedSimCard" => 'required',
			'integer',
			'min:1',
			Rule::exists('sim_cards', 'id') // Проверка существования контракта в таблице contracts
		];
	}
}
