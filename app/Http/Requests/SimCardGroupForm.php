<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimCardGroupForm extends FormRequest
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
			"entries" => "nullable|integer|min:1|max:100",
			"addedSimCardId" => 'required|integer|min:1',
			"groupName" => 'required|string|min:2|max:50',
			"contract" => 'required|integer|min:1',
        ];
    }

	/**
	 * Getting default values for attributes.
	 *
	 * @return array
	 */
	protected function prepareForValidation()
	{
		$entries = $this->input('entries');

		if ($entries > 100) {
			$entries = 100;
		} elseif (empty($entries) || $entries <= 0) {
			$entries = 10;
		}

		$this->merge([
			'entries' => $entries,
		]);
	}
}
