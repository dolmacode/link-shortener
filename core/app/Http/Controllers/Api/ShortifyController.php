<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;

class ShortifyController extends Controller
{
    public function __invoke() {
        $url = $request->url;

        $action = new ShortifyAction();
        $slug = $action->handle($url);
    }
}
