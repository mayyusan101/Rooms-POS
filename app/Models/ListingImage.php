<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    protected $appends = ['src']; // new attribute or field not inclued in database to appends in JOSN file

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function getSrcAttribute() //Like computed in Vue => generate new state upon its existing state
    {
        return asset("storage/{$this->filename}");
    }
}
