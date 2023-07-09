<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkPostRequest;
use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class LinkController extends Controller
{
    public function index(): View
    {
        return view('link.index');
    }

    public function store(LinkPostRequest $request): Response
    {
        $request->input('url');

        $link = new Link(['url' => $request->input('url')]);
        $link->save();

        return response(null, 201);
    }

    public function latest(): JsonResponse
    {
        $latest = Link::getLatestEntries();
        return response()->json($latest);
    }
}
