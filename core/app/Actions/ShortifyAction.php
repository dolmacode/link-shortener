<?php

namespace App\Actions;

use Illuminate\Support\Str;
use App\Models\Link;

class ShortifyAction {
    public function handle($url) {
        $slug = Str::random(8);

        if (empty(Link::where('slug', $slug)->first())) {
            $link = Link::create([
                'url' => $url,
                'slug' => $slug,
                'ip' => $_SERVER['REMOTE_ADDR'],
            ]);

            $link->save();

            return $slug;
        }

        // если такая сокращенная ссылка уже есть, запускаем процесс заново
        $this->handle($url);
    }
}