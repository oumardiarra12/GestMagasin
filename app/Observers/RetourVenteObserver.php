<?php

namespace App\Observers;

use App\Models\RetourVente;

class RetourVenteObserver
{
    /**
     * Handle the RetourVente "created" event.
     */
    public function created(RetourVente $retourVente): void
    {
        $retourVente->num_retourvente="RVENTE-".$retourVente->id;
        $retourVente->save();
    }

    /**
     * Handle the RetourVente "updated" event.
     */
    public function updated(RetourVente $retourVente): void
    {
        //
    }

    /**
     * Handle the RetourVente "deleted" event.
     */
    public function deleted(RetourVente $retourVente): void
    {
        //
    }

    /**
     * Handle the RetourVente "restored" event.
     */
    public function restored(RetourVente $retourVente): void
    {
        //
    }

    /**
     * Handle the RetourVente "force deleted" event.
     */
    public function forceDeleted(RetourVente $retourVente): void
    {
        //
    }
}
