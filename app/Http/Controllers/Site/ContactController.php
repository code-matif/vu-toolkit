<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $extensionId = $request->query('extension_id');
        $extensionVersion = $request->query('extension_version');

        return Inertia::render('Site/Contact/Index', [
            'extensionId' => $extensionId,
            'extensionVersion' => $extensionVersion,
        ]);
    }

    public function feedback(Request $request)
    {
        $extensionId = $request->query('extension_id');
        $extensionVersion = $request->query('extension_version');

        return Inertia::render('Site/Contact/Index', [
            'extensionId' => $extensionId,
            'extensionVersion' => $extensionVersion
        ]);
    }
    public function uninstall(Request $request)
    {
        $extensionId = $request->query('extension_id');
        $extensionVersion = $request->query('extension_version');

        return Inertia::render('Site/Contact/Index', [
            'extensionId' => $extensionId,
            'extensionVersion' => $extensionVersion,
            'uninstall' => true
        ]);
    }

    public function privacyPolicy(){
        return Inertia::render('Site/Contact/PrivacyPolicy');
    }
}
