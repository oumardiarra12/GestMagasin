<?php

namespace App\Observers;

use App\Models\PaiementVente;
use App\Models\Vente;

class PaiementVenteObserver
{
    /**
     * Handle the PaiementVente "created" event.
     */
    public function created(PaiementVente $paiementVente): void
    {
        $paiementVente->num_paiement_ventes="REGC-".$paiementVente->id;
        $paiementVente->save();
    }

    /**
     * Handle the PaiementVente "updated" event.
     */
    public function updated(PaiementVente $paiementVente): void
    {
        //
    }

    /**
     * Handle the PaiementVente "deleted" event.
     */
    public function deleted(PaiementVente $paiementVente): void
    {
        $vente =Vente::where('id',$paiementVente->vente_id)->get();
        $sumpaiementvente = $vente->sum(function ($vente) {
            return $vente->paiementventes->sum('total_payer');
        });
        $ventes =Vente::where('id',$paiementVente->vente_id)->first();
       $status=$ventes->total_vente-$sumpaiementvente;
        if ($status==0) {
         foreach ($vente as $key => $value) {
             $value->status_vente_payment="payer";
             $value->save();
         }

        }elseif ($status>0 && $sumpaiementvente > 0) {
         foreach ($vente as $key => $value) {
             $value->status_vente_payment="payer partial";
             $value->save();
         }
        }elseif($sumpaiementvente == 0){
         foreach ($vente as $key => $value) {
             $value->status_vente_payment="non payer";
             $value->save();
         }
        }
    }

    /**
     * Handle the PaiementVente "restored" event.
     */
    public function restored(PaiementVente $paiementVente): void
    {
        //
    }

    /**
     * Handle the PaiementVente "force deleted" event.
     */
    public function forceDeleted(PaiementVente $paiementVente): void
    {
        //
    }
}
