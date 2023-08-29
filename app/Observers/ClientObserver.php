<?php

namespace App\Observers;

use App\Models\Table;
use Illuminate\Support\Str;

class ClientObserver
{
    /**
     * Handle the product "creating" event.
     *
     * @param  \App\Models\Client  $product
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }
}
