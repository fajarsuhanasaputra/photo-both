<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'roles' => 'required',
        ];
    }

}
