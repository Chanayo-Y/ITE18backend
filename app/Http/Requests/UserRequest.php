<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if(request()->routeIs('users.login')) {
            return [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|in:admin,instructor,student',
            ];
        } else if(request()->routeIs('users.update')) {
            return [
                'name' => 'sometimes|required|string|max:255',
            ];
        } else if(request()->routeIs('users.email')) {
            return [
                'email' => 'required|string|email|max:255|unique:users',
            ];
        } else if(request()->routeIs('users.password')) {
            return [
                'password' => 'required|string|min:8|confirmed',
            ];
        }
        return [];
    }
}
