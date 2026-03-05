<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;

class NotInPastTime implements ValidationRule
{

    public function __construct(private $date)
    {
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->date > Carbon::now()->toDateString())
        {
            $fail('The date field must be a date after or equal to today');
        }

        if ($this->date === Carbon::now()->toDateString())
        {
            $dateTime = Carbon::parse($this->date . ' ' . $value);

            if (!$dateTime->isFuture())
            {
                $fail('Field time must be a time after now');
            }
        }
    }
}
