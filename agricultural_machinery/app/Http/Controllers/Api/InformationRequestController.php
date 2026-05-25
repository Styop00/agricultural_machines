<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\InformationRequestMail;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InformationRequestController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'preferred_contact_time' => ['nullable', 'string', 'max:255'],
            'request_type' => ['nullable', 'string', 'max:255'],
            'source_page' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $validated['preferred_contact_time'] ??= null;
        $validated['request_type'] ??= null;
        $validated['source_page'] ??= null;

        $recipient = Company::query()->value('email') ?: config('mail.from.address');

        Mail::to($recipient)->send(new InformationRequestMail($validated));

        return response()->json([
            'message' => 'Your request has been sent successfully.',
        ]);
    }
}
