<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

    class StoreUpdatePlans extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return Auth::check();
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {

            return [
                'name' => ['required', 'max:255'],
                'quantity' => ['required'],
                'value' => ['required'],
                'percentual_rendimento' => ['required'],
                'coin' => ['required'],
                'details' => ['max:350'],
                'time_pri' => ['required'],
            ];
        }
    }
