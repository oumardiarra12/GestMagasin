<?php

namespace App\Observers;

use App\Models\Vente;

class VenteObserver
{
    /**
     * Handle the Vente "created" event.
     */
    public function created(Vente $vente): void
    {
        $vente->num_vente="VENTE-".$vente->id;
        $vente->save();
    }

    /**
     * Handle the Vente "updated" event.
     */
    public function updated(Vente $vente): void
    {
        //
    }

    /**
     * Handle the Vente "deleted" event.
     */
    public function deleted(Vente $vente): void
    {
        //
    }

    /**
     * Handle the Vente "restored" event.
     */
    public function restored(Vente $vente): void
    {
        //
    }

    /**
     * Handle the Vente "force deleted" event.
     */
    public function forceDeleted(Vente $vente): void
    {
        //
    }
}
