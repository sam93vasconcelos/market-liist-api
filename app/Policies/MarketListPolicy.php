<?php

namespace App\Policies;

use App\Models\MarketList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MarketList  $marketList
     * @return mixed
     */
    public function view(User $user, MarketList $marketList)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MarketList  $marketList
     * @return mixed
     */
    public function update(User $user, MarketList $marketList)
    {
        return $user->id === $marketList->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MarketList  $marketList
     * @return mixed
     */
    public function delete(User $user, MarketList $marketList)
    {
        return $user->id === $marketList->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MarketList  $marketList
     * @return mixed
     */
    public function restore(User $user, MarketList $marketList)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MarketList  $marketList
     * @return mixed
     */
    public function forceDelete(User $user, MarketList $marketList)
    {
        //
    }
}
