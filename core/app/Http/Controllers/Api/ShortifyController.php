<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;

class ShortifyController extends Controller
{
    public function __invoke(Request $request) {
        $url = $request->url;

        $action = new ShortifyAction();
        $slug = $action->handle($url);

        if (!empty($slug)) {
            return response()->json(['data' => env('APP_URL') . '/' . $slug], 200);
        }

        return response()->json(['data' => 'Произошла ошибка сокращения ссылки, попробуйте снова'], 500);
    }
}
