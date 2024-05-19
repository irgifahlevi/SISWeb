<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Validation\Rule;

class MinimumDate implements Rule
{
    protected $days;

    public function __construct($days = 15)
    {
        $this->days = $days;
    }

    public function passes($attribute, $value)
    {
        $date = Carbon::parse($value);
        return $date->gte(Carbon::now()->addDays($this->days));
    }

    public function message()
    {
        return 'The :attribute must be a date at least ' . $this->days . ' days from today.';
    }
}
