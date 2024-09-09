<?php

namespace App\Http\Requests\Api\V1\SimCard;

use Illuminate\Foundation\Http\FormRequest;

class GetAllSimCardsRequest extends FormRequest
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
			"number" => "nullable|string|max:20"
		];
	}

	/**
	 * Getting default values for attributes.
	 *
	 * @return array
	 */
	protected function prepareForValidation()
	{
		$this->merge([
			'number' => $this->input('number') ?: null,
		]);
	}
}
