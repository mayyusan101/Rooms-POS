<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        // Accept offer
        $offer->update(['accepted_at' => now()]);
        $listing->sold_at = now(); // update in listing
        $listing->save();

        // Rejecte other offers for this listing
        $listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "Accept offer #{$offer->id}. Rejected other offers");
    }
}
