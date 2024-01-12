<?php

namespace App\Http\Controllers;

use App\Models\Listing;


class HomeController extends Controller
{
    public function index()
    {

        return inertia('Index/Home', [
            'lists' => Listing::all()
        ]);
    }
    public function show()
    {
        return inertia('Index/Show');
    }
}
