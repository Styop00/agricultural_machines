<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CareerApplicationMail;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CareerApplicationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
            'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt', 'max:5120'],
        ]);

        $recipient = Company::query()->value('email') ?: config('mail.from.address');
        $cv = $request->file('cv');
        unset($validated['cv']);

        $validated['message'] ??= null;

        Mail::to($recipient)->send(new CareerApplicationMail(
            data: $validated,
            attachmentPath: $cv?->getRealPath() ?: null,
            attachmentName: $cv?->getClientOriginalName(),
            attachmentMime: $cv?->getMimeType(),
        ));

        return response()->json([
            'message' => 'Your application has been sent successfully.',
        ]);
    }
}
