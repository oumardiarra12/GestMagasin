<?php

namespace App\Observers;

use App\Models\Depense;

class DepenseObserver
{
    /**
     * Handle the Depense "created" event.
     */
    public function created(Depense $depense): void
    {
        $depense->num_depense="DEP-".$depense->id;
        $depense->save();
    }

    /**
     * Handle the Depense "updated" event.
     */
    public function updated(Depense $depense): void
    {
        //
    }

    /**
     * Handle the Depense "deleted" event.
     */
    public function deleted(Depense $depense): void
    {
        //
    }

    /**
     * Handle the Depense "restored" event.
     */
    public function restored(Depense $depense): void
    {
        //
    }

    /**
     * Handle the Depense "force deleted" event.
     */
    public function forceDeleted(Depense $depense): void
    {
        //
    }
}
