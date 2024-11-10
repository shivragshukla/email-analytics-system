<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class CommaSeparatedEmails implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $emails = explode(',', $value);

        foreach ($emails as $email) {
            $validator = Validator::make(['email' => trim($email)], [
              'email' => 'required|email'
            ]);
          
            if ($validator->fails()) {
                $fail('The :attribute must be valid email addresses for email:'. $email);
            }
        }
    }
}
