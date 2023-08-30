<?php

namespace App\Observers;

use App\Models\RetourAchat;

class RetourAchatObserver
{
    /**
     * Handle the RetourAchat "created" event.
     */
    public function created(RetourAchat $retourAchat): void
    {
        $retourAchat->num_retour_achat="RACHAT-".$retourAchat->id;
        $retourAchat->save();
    }

    /**
     * Handle the RetourAchat "updated" event.
     */
    public function updated(RetourAchat $retourAchat): void
    {
        //
    }

    /**
     * Handle the RetourAchat "deleted" event.
     */
    public function deleted(RetourAchat $retourAchat): void
    {
        //
    }

    /**
     * Handle the RetourAchat "restored" event.
     */
    public function restored(RetourAchat $retourAchat): void
    {
        //
    }

    /**
     * Handle the RetourAchat "force deleted" event.
     */
    public function forceDeleted(RetourAchat $retourAchat): void
    {
        //
    }
}
