<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->method() === 'POST') {
            return true;
        } else {
            return Auth::id() === $this->route('comment')->author_id;
        }
    }

    public function rules(): array
    {
        if ($this->method() === 'DELETE') {
            return [];
        }

        return [
            'text' => 'required'
        ];
    }
}
