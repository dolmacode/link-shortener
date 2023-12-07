<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;
use Illuminate\Support\Facades\Session;
use App\Models\Link;

class ShortifyController extends Controller
{
    public function store(Request $request) {
        $url = $request->url;
        
        $action = new ShortifyAction();
        $slug = $action->handle($url);

        if (!empty($slug)) {
            Session::flash('success', 'Ваша ссылка: <a href="' . env('APP_URL') . '/' . $slug . '">' . env('APP_URL') . '/' . $slug . '</a>');
            return back();
        }

        Session::flash('error', 'Произошла ошибка сокращения ссылки, попробуйте снова');
        return back();
    }

    public function destroy($id) {
        $link = Link::find($id);

        if (!$link) {
            Session::flash('error', 'Ссылка не найдена!');
            return back();
        }

        if ($link->ip != $_SERVER['REMOTE_ADDR']) {
            Session::flash('error', 'Ссылка не принадлежит вам!');
            return back();
        }

        $link->delete();

        Session::flash('success', 'Ссылка успешно удалена!');
        return back();
    }
}
