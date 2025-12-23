<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        return response()->json([
            'message' => 'Sites fetched successfully',
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $site = Site::create([
            'title' => $request->title,
            'url' => $request->url,
        ]);

        return response()->json([
            'message' => 'Sites fetched successfully',
        ]);
    }
}
