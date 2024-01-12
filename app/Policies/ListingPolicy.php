<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    // public function before(User $user, $abality)
    // {
    //     if ($user?->is_admin /* && $abality === 'delete' */) {
    //         return true;
    //     }
    //     return null;
    // }


    public function viewAny(?User $user): bool
    {
        return true;    // All (with login or not)
    }

    public function view(?User $user, Listing $listing): bool
    {

        if ($listing->user_id === $user?->id) {
            return true; // always can access for owner evenif it was sold
        }
        return $listing->sold_at === null;    // All (with login or not) but when it was not sold
    }


    public function create(User $user): bool
    {
        return true;    // Only login user
    }


    public function update(User $user, Listing $listing): bool
    {
        return $listing->sold_at === null && ($user->id === $listing->user_id);
    }


    public function delete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }


    public function restore(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }

    public function forceDelete(User $user, Listing $listing): bool
    {
        return $user->id === $listing->user_id;
    }
}
