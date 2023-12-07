<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;
use App\Models\Link;

class ShortifyController extends Controller
{
    public function store(Request $request) {
        $url = $request->url;

        $action = new ShortifyAction();
        $slug = $action->handle($url);

        if (!empty($slug)) {
            return response()->json(['data' => env('APP_URL') . '/' . $slug], 200);
        }

        return response()->json(['data' => 'Произошла ошибка сокращения ссылки, попробуйте снова'], 500);
    }

    public function history() {
        $links = Link::where('ip', $_SERVER['REMOTE_ADDR'])->get();

        return response()->json(['data' => $links], 200);
    }

    public function destroy($id) {
        $link = Link::find($id);

        if (!$link) {
            return response()->json(['data' => 'Ссылка не найдена!'], 404);
        }

        if ($link->ip != $_SERVER['REMOTE_ADDR']) {
            return response()->json(['data' => 'Ссылка не принадлежит вам!'], 300);
        }

        $link->delete();

        return response()->json(['data' => 'Ссылка успешно удалена!'], 200);
    }
}
