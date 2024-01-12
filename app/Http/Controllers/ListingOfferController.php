<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;


class ListingOfferController extends Controller
{
    public function store(Request $request, Listing $listing,)
    {
        $this->authorize('view', $listing);
        // 1
        $validateArry = $request->validate([
            'amount' => 'required| integer|min: 1|max: 200000'
        ]);
        $offer = new Offer($validateArry);
        $offer->listing()->associate($listing);
        $offer->bidder()->associate($request->user());
        $offer->save();

        $offer->listing->owner->notify(new OfferMade($offer)); // set notification
        // Notification::send($offer->listing->owner, new OfferMade($offer));
        return redirect()->back()->with('success', 'Make an offer');
        // 2
        // $data = $listing->offers()->make($request->validate([
        //     'amount' => 'required|min: 1|max: 200000'
        // ]))->bidder()->associate($request->user());
        // $data->save();

        // 3
        // $listing->offers()->save(Offer::make($request->validate([
        //     'amount' => 'required|min: 1|max: 200000'
        // ]))->bidder()->associate($request->user()));


    }
}
