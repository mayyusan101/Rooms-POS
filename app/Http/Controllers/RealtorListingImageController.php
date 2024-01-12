<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{

    public function index()
    {
    }


    public function create(Listing $listing)
    {
        $listing->load('images');

        return inertia(
            'Realtor/ListingImage/Create',
            [
                'listing' => $listing
            ]
        );
    }


    public function store(Request $request, Listing $listing)
    {
        if ($request->hasFile('images')) {

            $request->validate([
                'images.*' => 'mimes:png,jpg, jpeg | max:5000'
            ], [
                'mimes' => 'The image must be type of png, jpg, jpeg'
            ]);
            foreach ($request->file('images') as $file) {
                $name = $file->getClientOriginalName();
                $path =  $file->storeAs('images', $name, 'public');

                $listing->images()->create([
                    'filename' => $path
                ]);
            }
        }
        return redirect()->back()->with('success', 'Images uploaded');
    }


    public function show(string $id)
    {
    }


    public function edit(string $id)
    {
    }


    public function update(Request $request, string $id)
    {
    }


    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted');
    }
}
