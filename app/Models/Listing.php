<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'listings';
    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_no', 'price', 'user_id', 'deleted_at'
    ];
    private $sortable = ['created_at', 'price'];



    // Local Scope
    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilter(Builder $query, array $filter): Builder
    {

        return  $query->when(
            $filter['priceFrom'] ?? false, // only ture
            fn ($query, $priceFrom) => $query->where('price', '>=', $priceFrom)
        )->when(
            $filter['priceTo'] ?? false,
            fn ($query, $priceTo) => $query->where('price', '<=', $priceTo)
        )->when(
            $filter['areaFrom'] ?? false,
            fn ($query, $areaFrom) => $query->where('area', '>=', $areaFrom)
        )->when(
            $filter['areaTo'] ?? false,
            fn ($query, $areaTo) => $query->where('area', '<=', $areaTo)
        )->when(
            $filter['beds'] ?? false,
            fn ($query, $beds) => $query->where('beds', $beds)
        )->when(
            $filter['baths'] ?? false,
            fn ($query, $baths) => $query->where('baths', $baths)
        )->when(
            $filter['delete'] ?? false,
            fn ($query, $value) => $query->withTrashed()
        )->when(
            $filter['by'] ?? false,
            fn ($query, $value) =>
            !in_array($value, $this->sortable) ? $query :
                $query->orderBy($value, $filter['order'] ?? 'desc')
        );
    }

    // Relationships
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeWithoutSold(Builder $query): Builder
    {
        return $query->whereNull('sold_at');
        // return $query->doesntHave('offers')
        //     ->orWhereHas('offers', fn (Builder $query) => $query->whereNull('accepted_at')->whereNull('rejected_at'));
    }
}
