<?php

namespace App\Http\Controllers\Api\V1\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
{
     

    public function rules()
    {
        return [
            'name'     => [
                'required'],
            'email'    => [
                'required',
                'unique:users'],
            'password' => [
                'required'],
            'roles'    => ['user'],
            'image' => ['sometimes','image'],   
        ];
    }
}
