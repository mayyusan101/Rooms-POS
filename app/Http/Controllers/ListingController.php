<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;


class ListingController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except(['index', 'show']);   // validate login user
        $this->authorizeResource(Listing::class, 'listing');    // authorize listing
    }
    public function index(Request $request)
    {
        $queryParams = $request->query();   // give all query for filtering products

        return inertia('Index/Home', [
            'lists' => Listing::mostRecent()
                ->filter($queryParams)
                ->withoutSold()
                ->paginate(7)
                ->withQueryString(),
            'filters' => $queryParams
        ]);
    }


    public function show(Listing $listing)
    {
        // if(!Auth::user()->cannot('view', $listing)) {
        //     abort(404);
        // }
        $this->authorize('view', $listing);

        $listing->load(['images']);

        $offer = !Auth::user() ? null : $listing->offers()->byUser()->first();

        return inertia('Listing/Show', [
            'list' => $listing,
            'offerMade' => $offer
        ]);
    }
}
