<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
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
        'car_number' => 'required|numeric|unique:ambulances,car_number,'.$this->id,
        'car_model' => 'required',
        'car_year_made' => 'required',
        'car_type' => 'required',
        'driver_name' => 'required',
        'driver_license_number' => 'required',
        'driver_phone' => 'required',
        ];
    }
}
