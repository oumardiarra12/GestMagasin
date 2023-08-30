<?php

namespace App\Observers;

use App\Models\Devis;

class DevisObserver
{
    /**
     * Handle the Devis "created" event.
     */
    public function created(Devis $devis): void
    {
        $devis->num_devis="DEVIS-".$devis->id;
        $devis->save();
    }

    /**
     * Handle the Devis "updated" event.
     */
    public function updated(Devis $devis): void
    {
        //
    }

    /**
     * Handle the Devis "deleted" event.
     */
    public function deleted(Devis $devis): void
    {
        //
    }

    /**
     * Handle the Devis "restored" event.
     */
    public function restored(Devis $devis): void
    {
        //
    }

    /**
     * Handle the Devis "force deleted" event.
     */
    public function forceDeleted(Devis $devis): void
    {
        //
    }
}
