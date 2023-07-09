<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function redirect(string $path): RedirectResponse
    {
        $url = Link::getUrlByShortPath($path);
        if ($url) {
            return redirect()->away($url);
        } else {
            abort(404);
        }
    }
}
