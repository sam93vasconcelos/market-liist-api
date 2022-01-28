<?php

namespace App\Providers;

use App\Models\ListItem;
use App\Models\MarketList;
use App\Policies\ListItemPolicy;
use App\Policies\MarketListPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        MarketList::class => MarketListPolicy::class,
        ListItem::class => ListItemPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
