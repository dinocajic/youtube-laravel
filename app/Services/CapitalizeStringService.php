<?php

namespace App\Services;

class CapitalizeStringService
{
    public function capitalize($string)
    {
        return strtoupper($string);
    }
}
