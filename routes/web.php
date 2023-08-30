<?php

use App\Http\Controllers\AchatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategorieDepenseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FamilleController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaiementAchatController;
use App\Http\Controllers\PaiementVenteController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RetourAchatController;
use App\Http\Controllers\RetourVenteController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\UniteController;
use App\Http\Controllers\VenteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'Login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
//Auth::routes();
// Route::middleware(['auth'])->group(function () {
//     Route::get('logout', [LoginController::class, 'logout'])->name('login.logout');
//     Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
//     Route::put('/profileupdate',[ProfileController::class,'update'])->name('profile.update');
/**
 * Route utilisateur
 */
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profileupdate', [ProfileController::class, 'update'])->name('profile.update');
    Route::middleware("auth.admin")->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        /**
         * Route utilisateur
         */
        Route::controller(RegisterController::class)->group(function () {
            Route::prefix('/utilisateur')->group(function () {
                Route::name('utilisateur.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    // Route::get('/show/{id}', 'show')->name('show');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                });
            });
        });
    });
    Route::middleware('auth.adminormanager')->group(function(){
/**
     * Route categorie
     */
    Route::controller(FamilleController::class)->group(function () {
        Route::prefix('/categories')->group(function () {
            Route::name('categories.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                //Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
            });
        });
    });
     /**
     * Route unites
     */
    Route::controller(UniteController::class)->group(function () {
        Route::prefix('/unites')->group(function () {
            Route::name('unites.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                //Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
            });
        });
    });
     /**
     * Route produits
     */
    Route::controller(ProduitController::class)->group(function () {
        Route::prefix('/produits')->group(function () {
            Route::name('produits.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/import', 'importproduit')->name('import');
                Route::post('/importproduit', 'importstoreproduit')->name('importproduit');
                Route::get('/export', 'exportproduit')->name('export');
                Route::get('/produitpdf', 'produitpdf')->name('produitpdf');
                Route::get('listecodebarre','generecodebarre')->name('listecodebarre');
                Route::get('generercodebarre','genererpdfcodebarre')->name('generercodebarre');
            });
        });
    });
      /**
     * Route Fournisseurs
     */
    Route::controller(FournisseurController::class)->group(function () {
        Route::prefix('/fournisseurs')->group(function () {
            Route::name('fournisseurs.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/import', 'importfournisseur')->name('import');
                Route::post('/importfournisseur', 'importstorefournisseur')->name('importfournisseur');
                Route::get('/export', 'exportfournisseur')->name('export');
                Route::get('/fournisseurpdf', 'fournisseurpdf')->name('fournisseurpdf');
            });
        });
    });
     /**
     * Route societe
     */
    Route::controller(SocieteController::class)->group(function () {
        Route::prefix('/societes')->group(function () {
            Route::name('societes.')->group(function () {
                //Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                //Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
               // Route::post('/update/{id}', 'update')->name('update');
                //Route::delete('/delete/{id}', 'destroy')->name('delete');
            });
        });
    });
      /**
     * Route Categorie Depense
     */
    Route::controller(CategorieDepenseController::class)->group(function () {
        Route::prefix('/categoriedepenses')->group(function () {
            Route::name('categoriedepenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                //Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
            });
        });
    });
    /**
     * Route Depenses
     */
    Route::controller(DepenseController::class)->group(function () {
        Route::prefix('/depenses')->group(function () {
            Route::name('depenses.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                // Route::get('/import', 'importdepense')->name('import');
                //Route::post('/importdepense', 'importstoredepense')->name('importdepense');
                Route::get('/export', 'exportdepense')->name('export');
                Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
     /**
     * Route Achats
     */
    Route::controller(AchatController::class)->group(function () {
        Route::prefix('/achats')->group(function () {
            Route::name('achats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/rechercheproduit', 'RechercheProduit')->name('rechercheproduit');
                Route::get('/exportpdfachat/{id}', 'pdfligneachat')->name('exportpdfachat');
                Route::get('/export', 'exportachat')->name('export');
                Route::get('/achatpdf', 'achatpdf')->name('achatpdf');
                Route::get('/createpaiement/{id}','createpaiement')->name('createpaiement');
                Route::post('/storepaiement','storepaiement')->name('storepaiement');
                Route::get('/voirpaiement/{id}','voirpaiement')->name('voirpaiement');
                Route::get('/retourachatcreate/{id}','retourachatcreate')->name('retourachatcreate');
                Route::post('/updatepaiement/{id}','updatepaiement')->name('updatepaiement');
                Route::delete('/deletepaiement/{id}','deletepaiement')->name('deletepaiement');
            });
        });
    });
    /**
     * Route Paiement Achat
     */
    Route::controller(PaiementAchatController::class)->group(function () {
        Route::prefix('/paiementachats')->group(function () {
            Route::name('paiementachats.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/export/{id}', 'pdfpaiementachat')->name('export');
                Route::get('/creance', 'creance')->name('creance');
                //Route::post('/importdepense', 'importstoredepense')->name('importdepense');
                // Route::get('/export', 'exportdepense')->name('export');
                // Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
     /**
     * Route Retour Achat
     */
    Route::controller(RetourAchatController::class)->group(function () {
        Route::prefix('/retourachats')->group(function () {
            Route::name('retourachats.')->group(function () {
                Route::get('/', 'index')->name('index');
               // Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/exportretourachat/{id}', 'pdfligneachatretour')->name('exportretourachat');
                Route::get('/exporttable', 'achatretourpdf')->name('exporttable');
                // Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
      /**
     * Route Ventes
     */
    Route::controller(VenteController::class)->group(function () {
        Route::prefix('/ventes')->group(function () {
            Route::name('ventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/comptoir', 'createcomptoir')->name('createcomptoir');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                // Route::post('/storecomptoir', 'storecomptoir')->name('storecomptoir');
                // Route::post('/storeclient', 'storeclient')->name('storeclient');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/rechercheproduit', 'RechercheProduit')->name('rechercheproduit');
                Route::get('/exportpdfvente/{id}', 'pdflignevente')->name('exportpdfvente');
                // Route::get('/exportpdftiket/{id}', 'pdfcomptoir')->name('exportpdftiket');
                Route::get('/export', 'exportvente')->name('export');
                Route::get('/ventepdf', 'ventepdf')->name('ventepdf');
                Route::get('/venterecentpdf', 'venterecentpdf')->name('venterecentpdf');
                Route::get('/createpaiement/{id}','createpaiement')->name('createpaiement');
                Route::post('/storepaiement','storepaiement')->name('storepaiement');
                Route::get('/retourventecreate/{id}','retourventecreate')->name('retourventecreate');
                Route::post('/updatepaiement/{id}','updatepaiement')->name('updatepaiement');
                Route::delete('/deletepaiement/{id}','deletepaiement')->name('deletepaiement');
            });
        });
    });
    /**
     * Route Paiement Vente
     */
    Route::controller(PaiementVenteController::class)->group(function () {
        Route::prefix('/paiementventes')->group(function () {
            Route::name('paiementventes.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                //  Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/export/{id}', 'pdfpaiementvente')->name('export');
                Route::get('/dette', 'dette')->name('dette');
                //Route::post('/importdepense', 'importstoredepense')->name('importdepense');
                // Route::get('/export', 'exportdepense')->name('export');
                // Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
     /**
     * Route Retour Vente
     */
    Route::controller(RetourVenteController::class)->group(function () {
        Route::prefix('/retourventes')->group(function () {
            Route::name('retourventes.')->group(function () {
                Route::get('/', 'index')->name('index');
               // Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store/{id}', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/exportretourvente/{id}', 'pdfligneventeretour')->name('exportretourvente');
                Route::get('/exporttable', 'venteretourpdf')->name('exporttable');
                // Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
     /**
     * Route Devis
     */
    Route::controller(DevisController::class)->group(function () {
        Route::prefix('/devis')->group(function () {
            Route::name('devis.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                 Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::put('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/rechercheproduit', 'RechercheProduit')->name('rechercheproduit');
                Route::get('/exportdevis/{id}', 'pdflignedevis')->name('exportdevis');
                Route::get('/exporttable', 'devispdf')->name('exporttable');
                Route::get('/createvente/{id}', 'createvente')->name('createvente');
                Route::post('/storevente', 'storevente')->name('storevente');
                // Route::get('/depensepdf', 'depensepdf')->name('depensepdf');
            });
        });
    });
     /**
     * Route Rapports
     */
    Route::controller(RapportController::class)->group(function () {
        Route::prefix('/rapports')->group(function () {
            Route::name('rapports.')->group(function () {
                Route::get('/rapportachats', 'rapportachat')->name('rapportachats');
                Route::get('/rapportachatpdf', 'rapportachatpdf')->name('rapportachatpdf');
                Route::get('/rapportventes', 'rapportvente')->name('rapportventes');
                Route::get('/rapportpaiementventes', 'rapportpaiementvente')->name('rapportpaiementventes');
                Route::get('/rapportpaiementachats', 'rapportpaiementachat')->name('rapportpaiementachats');
                Route::get('/rapportdepenses', 'rapportdepense')->name('rapportdepenses');
            });
        });
    });
});
Route::middleware('auth.adminormanageroragent')->group(function(){

     /**
     * Route clients
     */
    Route::controller(ClientController::class)->group(function () {
        Route::prefix('/clients')->group(function () {
            Route::name('clients.')->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                // Route::get('/show/{id}', 'show')->name('show');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update/{id}', 'update')->name('update');
                Route::delete('/delete/{id}', 'destroy')->name('delete');
                Route::get('/import', 'importclient')->name('import');
                Route::post('/importclient', 'importstoreclient')->name('importclient');
                Route::get('/export', 'exportclient')->name('export');
                Route::get('/clientpdf', 'clientpdf')->name('clientpdf');
            });
        });
    });
     /**
     * Route Ventes
     */
    Route::controller(VenteController::class)->group(function () {
        Route::prefix('/ventes')->group(function () {
            Route::name('ventes.')->group(function () {
                // Route::get('/', 'index')->name('index');
                Route::get('/show/{id}', 'show')->name('show');
                Route::get('/rechercheproduit', 'RechercheProduit')->name('rechercheproduit');
                Route::get('/voirpaiement/{id}','voirpaiement')->name('voirpaiement');
            });
        });
    });
     /**
     * Route Paiement Vente
     */
    Route::controller(PaiementVenteController::class)->group(function () {
        Route::prefix('/paiementventes')->group(function () {
            Route::name('paiementventes.')->group(function () {
                 Route::get('/show/{id}', 'show')->name('show');
            });
        });

});
Route::middleware('auth.manager')->group(function(){
    Route::get('/gerant', [HomeController::class, 'homegerant'])->name('home');
});
Route::middleware('auth.agent')->group(function(){
    Route::get('/user', [HomeController::class, 'homeagent'])->name('home');
      /**
     * Route Ventes
     */
    Route::controller(VenteController::class)->group(function () {
        Route::prefix('/ventes')->group(function () {
            Route::name('ventes.')->group(function () {
                Route::get('/mesventes','mesvente')->name('mesventes');
                Route::get('/comptoir', 'createcomptoir')->name('createcomptoir');
                Route::post('/storecomptoir', 'storecomptoir')->name('storecomptoir');
                Route::post('/storeclient', 'storeclient')->name('storeclient');
                Route::get('/exportpdftiket/{id}', 'pdfcomptoir')->name('exportpdftiket');
                Route::get('/mesventespdf', 'mesventespdf')->name('mesventespdf');
            });
        });
    });
});
});
});
