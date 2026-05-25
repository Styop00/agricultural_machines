<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected function perPage(Request $request): int
    {
        return min((int) $request->integer('per_page', 15), 100);
    }
}
