<?php

namespace App\Providers;

use App\Models\Achat;
use App\Models\Depense;
use App\Models\Devis;
use App\Models\PaiementAchat;
use App\Models\PaiementVente;
use App\Models\Produit;
use App\Models\RetourAchat;
use App\Models\RetourVente;
use App\Models\Vente;
use App\Observers\AchatObserver;
use App\Observers\DepenseObserver;
use App\Observers\DevisObserver;
use App\Observers\PaiementAchatObserver;
use App\Observers\PaiementVenteObserver;
use App\Observers\ProduitObserver;
use App\Observers\RetourAchatObserver;
use App\Observers\RetourVenteObserver;
use App\Observers\VenteObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Produit::observe(ProduitObserver::class);
        Depense::observe(DepenseObserver::class);
        Achat::observe(AchatObserver::class);
        PaiementAchat::observe(PaiementAchatObserver::class);
        RetourAchat::observe(RetourAchatObserver::class);
        Vente::observe(VenteObserver::class);
        PaiementVente::observe(PaiementVenteObserver::class);
        RetourVente::observe(RetourVenteObserver::class);
        Devis::observe(DevisObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
