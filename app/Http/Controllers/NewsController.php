<?php

namespace App\Http\Controllers;

use App\Services\NewsRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class NewsController extends Controller
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index(): Response
    {
        $posts = $this->newsRepository->posts();

        return Inertia::render('News', [
            'posts' => $posts
        ]);
    }
}
