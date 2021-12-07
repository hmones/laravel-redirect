<?php

namespace Hmones\LaravelRedirect\Http\Requests;

use Hmones\LaravelRedirect\RedirectConfiguration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RedirectRequest
{
    use RedirectConfiguration;

    protected $data;

    public function __construct()
    {
        $this->data = request($this->parameterName());
    }

    public function rules(): array
    {
        return [
            $this->parameterName() => array_merge([
                'required',
                'url',
                Rule::notIn($this->excludedRoutes()),
            ], $this->parameterRegex() ? ['regex:'.$this->parameterRegex()] : []),
        ];
    }

    public function getParameterUrl(): ?string
    {
        $this->data = urldecode($this->data);
        $this->validate();

        return $this->data;
    }

    protected function validate(): ?ValidationException
    {
        $validator = Validator::make([$this->parameterName() => $this->data], $this->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return null;
    }
}
