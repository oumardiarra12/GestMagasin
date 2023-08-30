<?php

namespace App\Observers;

use App\Models\Achat;
use App\Models\PaiementAchat;
use Illuminate\Support\Facades\DB;

class PaiementAchatObserver
{
    /**
     * Handle the PaiementAchat "created" event.
     */
    public function created(PaiementAchat $paiementAchat): void
    {
        $paiementAchat->num_paiement_achats="REGF-".$paiementAchat->id;
        $paiementAchat->save();
    }

    /**
     * Handle the PaiementAchat "updated" event.
     */
    public function updated(PaiementAchat $paiementAchat): void
    {
        //
    }


    /**
     * Handle the PaiementAchat "deleted" event.
     */

    public function deleted(PaiementAchat $paiementAchat)
    {
        $achat =Achat::where('id',$paiementAchat->achat_id)->get();
        $sumpaiementachat = $achat->sum(function ($achat) {
            return $achat->paiementachats->sum('total_payer');
        });
        $achats =Achat::where('id',$paiementAchat->achat_id)->first();
       $status=$achats->total_achat-$sumpaiementachat;
        if ($status==0) {
         foreach ($achat as $key => $value) {
             $value->status_achat_payment="pay";
             $value->save();
         }

        }elseif ($status>0 && $sumpaiementachat > 0) {
         foreach ($achat as $key => $value) {
             $value->status_achat_payment="pay partial";
             $value->save();
         }
        }elseif($sumpaiementachat == 0){
         foreach ($achat as $key => $value) {
             $value->status_achat_payment="no pay";
             $value->save();
         }
        }
    }

    /**
     * Handle the PaiementAchat "restored" event.
     */
    public function restored(PaiementAchat $paiementAchat): void
    {
        //
    }

    /**
     * Handle the PaiementAchat "force deleted" event.
     */
    public function forceDeleted(PaiementAchat $paiementAchat): void
    {
        //
    }
}
