<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;
use Illuminate\Support\Facades\Session;

class ShortifyController extends Controller
{
    public function __invoke(Request $request) {
        $url = $request->url;
        
        $action = new ShortifyAction();
        $slug = $action->handle($url);

        if (!empty($slug)) {
            Session::flash('success', 'Ваша ссылка: <a href="' . env('APP_URL') . '/' . $slug . '">' . env('APP_URL') . '/' . $slug . '</a>');
            return back();
        }

        Session::flash('success', 'Произошла ошибка сокращения ссылки, попробуйте снова');
        return back();
    }
}
