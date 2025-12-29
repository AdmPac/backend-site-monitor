<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{

    public function index()
    {
        return response()->json([
            'message' => 'Sites fetched successfully',
        ]);
    }

    public function create(SiteRequest $request)
    {
        $data = $request->validated();
        $site = Site::create([
            'title' => $data['title'],
            'full_url' => $data['full_url'],
            'base_url' => $data['base_url'],
            'user_id' => Auth::id(),
        ]);
        if ($site) {
            return response()->json([
                'message' => 'Сайт успешно добавлен',
            ]);
        } else {
            return response()->json([
                'message' => 'Ошибка добавления сайта',
            ], 500);
        }
    }

    public function all()
    {
        $data = Site::where('user_id', Auth::id())->get();
        return response()->json($data);
    }

    public function get(int $id)
    {
        $site = Site::find($id);
        if (!$site) {
            return response()->json([
                'success' => false,
                'message' => 'Сайта не существует',
            ], 404);
        } 
        return response()->json($site);
    }
}
