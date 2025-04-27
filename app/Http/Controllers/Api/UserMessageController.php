<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:contact,feedback,suggestion,goodbye',
            'uninstall_reason' => 'nullable|string|max:255',
            'extension_id' => 'nullable|string|max:255',
            'extension_version' => 'nullable|string|max:50',
        ]);

        // After basic validation, add custom manual check:
        $validator->after(function ($validator) use ($request) {
            if (empty($request->email) && empty($request->phone)) {
                $validator->errors()->add('email', 'Either email or phone is required.');
                $validator->errors()->add('phone', 'Either email or phone is required.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Store the message
        $message = UserMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'type' => $request->type,
            'extension_id' => $request->extension_id,
            'extension_version' => $request->extension_version,
        ]);

        return response()->json(['message' => 'User message stored successfully!', 'data' => $message], 201);
    }
}
