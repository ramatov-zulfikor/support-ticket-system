<?php

namespace App\Http\Requests\Api;

use App\Enums\TicketTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->method() === 'POST') {
            return true;
        } else {
            return Auth::id() === $this->route('ticket')->author_id;
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:issue,suggestion']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'author_id' => Auth::id(),
            'type' => $validated['type'] === Str::lower(TicketTypeEnum::ISSUE->name)
                ? TicketTypeEnum::ISSUE
                : TicketTypeEnum::SUGGESTION
        ]);
    }
}
