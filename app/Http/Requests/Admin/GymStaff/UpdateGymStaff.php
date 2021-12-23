<?php

namespace App\Http\Requests\Admin\GymStaff;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateGymStaff extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.gym-staff.edit', $this->gymStaff);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'email' => ['nullable', 'email', 'string'],
            'phone' => ['nullable', 'string'],
            'clubready_owner_id' => ['nullable', 'string'],
            'event_uuid' => ['nullable', 'string'],
            'gym_staff_type' => ['nullable'],
            'gym_location' => ['nullable'],

        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }

    public function getGymStaffTypeId() {
        if($this->has('gym_staff_type') && !empty($this->get('gym_staff_type'))) {
            return $this->get('gym_staff_type')['id'];
        }
        return null;
    }

    public function getGymLocationId() {
        if($this->has('gym_location') && !empty($this->get('gym_location'))) {
            return $this->get('gym_location')['id'];
        }
        return null;
    }
}
