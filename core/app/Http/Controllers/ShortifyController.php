<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\ShortifyAction;

class ShortifyController extends Controller
{
    public function __invoke(Request $request) {
        $url = $request->url;
        
        $action = new ShortifyAction();
        $slug = $action->handle($url);
    }
}
