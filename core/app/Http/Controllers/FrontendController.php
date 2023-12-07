<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        return view('pages.index');
    }
    
    public function show($slug) {
        $link = Link::where('slug', $slug)->firstOrFail();
        
        // инкрементируем счетчик посещений ссылки
        
        $link->increment('visits', 1);
        
        // доп. проверку не добавляем, тк либо система найдет ссылку, либо вернет 404
        
        return redirect($link->url);
    }
}
