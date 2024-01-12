<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    public function index(Request $request)
    {
        $filter = [
            'delete' => $request->boolean('delete'), // change to Boolean value
            ...$request->only(['by', 'order'])
        ];
        return inertia(
            'Realtor/Index',
            [
                'listings' => Auth::user()->listings()
                    ->mostRecent()
                    ->filter($filter)
                    ->withCount('images')
                    ->withCount('offers')
                    ->paginate(6)
                    ->withQueryString(),
                'filters' => $filter,
                'sold' => true
            ]
        );
    }

    public function create()
    {
        return inertia('Realtor/Create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'beds' => 'required|integer|min:0|max:9',
            'baths' => 'required|integer|min:0|max:9',
            'area' => 'required|integer|min:0|max:400',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_no' => 'required|integer|min:0|max:9',
            'price' => 'required|integer|min:0|max:200000',
        ]);

        $data['user_id'] = $request->user()->id;

        Listing::create($data);
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was created');
    }


    public function show(Listing $listing) // Route Model Binding
    {
        $listing->load('offers', 'offers.bidder');
        return inertia('Realtor/Show', [
            'listing' => $listing
        ]);
    }


    public function edit(Listing $listing)
    {
        return inertia('Realtor/Edit', [
            'list' => $listing
        ]);
    }


    public function update(Request $request, Listing $listing)
    {

        $data = $request->validate([
            'beds' => 'required|integer|min:0|max:9',
            'baths' => 'required|integer|min:0|max:9',
            'area' => 'required|integer|min:0|max:400',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_no' => 'required|integer|min:0|max:9',
            'price' => 'required|integer|min:0|max:200000',
        ]);

        $data['user_id'] = $request->user()->id;
        Listing::where('id', $listing->id)->update($data);
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was updated');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete(); // soft delete
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was deleted');
    }

    public function restore(Listing $listing)
    {
        $listing->restore(); // soft delete
        return redirect()->route('realtor.listing.index')->with('success', 'Listing was restored');
    }
}
