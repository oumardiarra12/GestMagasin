@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                @can('admin')
                    <li>
                        <a class=" {{ \Request::route()->getName() == 'home' ? 'active' : ' ' }}"
                            href="{{ url('/') }}"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                Dashboard</span>
                        </a>
                    </li>
                @endcan
                @can('manager')
                    <li>
                        <a class=" {{ \Request::route()->getName() == 'home' ? 'active' : ' ' }}"
                            href="{{ url('/gerant') }}"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                Dashboard</span>
                        </a>
                    </li>
                @endcan
                @can('agent')
                    <li>
                        <a class=" {{ \Request::route()->getName() == 'home' ? 'active' : ' ' }}"
                            href="{{ url('/user') }}"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                Dashboard</span>
                        </a>
                    </li>
                @endcan
                @canany(['admin', 'manager'])
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'categories' || $segment1 == 'unites' || $segment1 == 'produits' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                                Produit</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('produits.index') }}"
                                    class="{{ \Request::route()->getName() == 'produits.index' ? 'active' : ' ' }}">Liste
                                    Produit</a></li>
                            <li><a href="{{ route('produits.create') }}"
                                    class="{{ \Request::route()->getName() == 'produits.create' ? 'active' : ' ' }}">Nouveau
                                    Produit</a></li>
                            <li><a href="{{ route('categories.index') }}"
                                    class="{{ \Request::route()->getName() == 'categories.index' ? 'active' : ' ' }}">Liste
                                    Categorie</a></li>
                            <li><a href="{{ route('unites.index') }}"
                                    class="{{ \Request::route()->getName() == 'unites.index' ? 'active' : ' ' }}">Liste
                                    Unite</a></li>
                            <li><a href="{{ route('produits.import') }}"
                                    class="{{ \Request::route()->getName() == 'produits.import' ? 'active' : ' ' }}">Importe
                                    Produits</a></li>
                            <li><a href="{{ route('produits.listecodebarre') }}"
                                    class="{{ \Request::route()->getName() == 'produits.listecodebarre' ? 'active' : ' ' }}">code
                                    Barre</a></li>
                        </ul>
                    </li>
                @endcanany
                @canany(['admin', 'manager'])
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'ventes' || $segment1 == 'paiementventes' || $segment1 == 'devis' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span>
                                Vente</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('ventes.index') }}"
                                    class="{{ \Request::route()->getName() == 'ventes.index' || \Request::route()->getName() == 'ventes.edit' ? 'active' : ' ' }}">Liste
                                    de Ventes</a></li>
                        @endcanany
                        {{-- @can('agent')
                            <li><a href="{{ route('ventes.createcomptoir') }}"
                                    class="{{ \Request::route()->getName() == 'ventes.createcomptoir' ? 'active' : ' ' }}">Comptoir</a>
                            </li>
                        @endcan --}}
                        @canany(['admin', 'manager'])
                            <li><a href="{{ route('ventes.create') }}"
                                    class="{{ \Request::route()->getName() == 'ventes.create' ? 'active' : ' ' }}">Nouveau
                                    Vente</a></li>
                            <li><a href="{{ route('devis.index') }}"
                                    class="{{ \Request::route()->getName() == 'devis.index' || \Request::route()->getName() == 'devis.show' || \Request::route()->getName() == 'devis.edit' || \Request::route()->getName() == 'devis.createvente' ? 'active' : ' ' }}">Liste
                                    de Devis</a></li>
                            <li><a href="{{ route('devis.create') }}"
                                    class="{{ \Request::route()->getName() == 'devis.create' ? 'active' : ' ' }}">Nouveau
                                    de Devis</a></li>
                        </ul>
                    </li>
                @endcanany
                @canany(['admin', 'manager'])
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'achats' ? 'active' : ' ' }}" href="javascript:void(0);"><img
                                src="assets/img/icons/purchase1.svg" alt="img"><span>
                                Achat</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('achats.index') }}"
                                    class="{{ \Request::route()->getName() == 'achats.index' || \Request::route()->getName() == 'achats.edit' ? 'active' : ' ' }}">Liste
                                    d'Achat</a></li>
                            <li><a href="{{ route('achats.create') }}"
                                    class="{{ \Request::route()->getName() == 'achats.create' ? 'active' : ' ' }}">Nouveau
                                    d'Achat</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'depenses' || $segment1 == 'categoriedepenses' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span>
                                Depense</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('depenses.index') }}"
                                    class="{{ \Request::route()->getName() == 'depenses.index' ? 'active' : ' ' }}">Liste
                                    des Depenses</a></li>
                            <li><a href="{{ route('depenses.create') }}"
                                    class="{{ \Request::route()->getName() == 'depenses.create' ? 'active' : ' ' }}">Nouveau
                                    de Depense</a></li>
                            <li><a href="{{ route('categoriedepenses.index') }}"
                                    class="{{ \Request::route()->getName() == 'categoriedepenses.index' || \Request::route()->getName() == 'categoriedepenses.create' ? 'active' : ' ' }}">Categorie
                                    de Depense</a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                        <a  href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img"><span>
                                Devis</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="quotationList.html">Liste de Devis</a></li>
                            <li><a href="addquotation.html">Nouveau de Devis</a></li>
                        </ul>
                    </li> --}}
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'retourachats' || $segment1 == 'retourventes' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span>
                                Les Retours</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('retourventes.index') }}"
                                    class="{{ \Request::route()->getName() == 'retourventes.index' || \Request::route()->getName() == 'retourventes.edit' || \Request::route()->getName() == 'retourventes.show' ? 'active' : ' ' }}">Liste
                                    de Retour Vente</a></li>
                            <li><a href="{{ route('retourachats.index') }}"
                                    class="{{ \Request::route()->getName() == 'retourachats.index' || \Request::route()->getName() == 'retourachats.edit' || \Request::route()->getName() == 'retourachats.show' ? 'active' : ' ' }}">Liste
                                    de Retour Achat</a></li>
                        </ul>
                    </li>
                @endcanany
                @canany(['admin', 'manager', 'agent'])
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'clients' || $segment1 == 'fournisseurs' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                                Contacts</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('clients.index') }}"
                                    class="{{ \Request::route()->getName() == 'clients.index' || \Request::route()->getName() == 'clients.create' ? 'active' : ' ' }}">Liste
                                    de Clients</a></li>
                            <li><a href="{{ route('clients.import') }}"
                                    class="{{ \Request::route()->getName() == 'clients.import' ? 'active' : ' ' }}">Import
                                    de Client </a></li>
                        @endcanany
                        @canany(['admin', 'manager'])
                            <li><a href="{{ route('fournisseurs.index') }}"
                                    class="{{ \Request::route()->getName() == 'fournisseurs.index' || \Request::route()->getName() == 'fournisseurs.create' ? 'active' : ' ' }}">Liste
                                    de Fournisseurs</a></li>
                            <li><a href="{{ route('fournisseurs.import') }}"
                                    class="{{ \Request::route()->getName() == 'fournisseurs.import' ? 'active' : ' ' }}">Import
                                    de Fournisseur </a></li>
                        @endcanany
                        @canany(['admin', 'manager', 'agent'])

                        </ul>
                    </li>
                @endcanany
                @canany(['admin', 'manager'])
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'rapports'  ? 'active' : ' ' }}" href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span>
                                Rapport</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{route('rapports.rapportachats')}}" class="{{ \Request::route()->getName() == 'rapports.rapportachats' ? 'active' : ' ' }}">Rapport d'Achat</a></li>
                            <li><a href="{{route('rapports.rapportventes')}}" class="{{ \Request::route()->getName() == 'rapports.rapportventes' ? 'active' : ' ' }}">Rapport de Vente</a></li>
                            <li><a href="{{route('rapports.rapportpaiementventes')}}" class="{{ \Request::route()->getName() == 'rapports.rapportpaiementventes' ? 'active' : ' ' }}">Rapport de Paiement Client</a></li>
                            <li><a href="{{route('rapports.rapportpaiementachats')}}" class="{{ \Request::route()->getName() == 'rapports.rapportpaiementachats' ? 'active' : ' ' }}">Rapport de Paiement Fournisseur</a></li>
                            <li><a href="{{route('rapports.rapportdepenses')}}" class="{{ \Request::route()->getName() == 'rapports.rapportdepenses' ? 'active' : ' ' }}">Rapport de Depense</a></li>
                        </ul>
                    </li>
                    {{-- <li class="submenu">
                        <a class=" {{ $segment1 == 'paiementachats' || $segment1 == 'paiementventes' ? 'active' : ' ' }}"
                            href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span>
                               Recouvrement</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('retourventes.index') }}"
                                    class="{{ \Request::route()->getName() == 'retourventes.index' || \Request::route()->getName() == 'retourventes.edit' || \Request::route()->getName() == 'retourventes.show' ? 'active' : ' ' }}">Liste
                                    Creance</a></li>
                            <li><a href="{{ route('retourachats.index') }}"
                                    class="{{ \Request::route()->getName() == 'retourachats.index' || \Request::route()->getName() == 'retourachats.edit' || \Request::route()->getName() == 'retourachats.show' ? 'active' : ' ' }}">Liste
                                   Dette</a></li>
                        </ul>
                    </li> --}}
                @endcan

                @can('agent')
                    <li class="submenu">
                        <a  class=" {{ $segment1 == 'ventes' || $segment1 == 'paiementventes'  ? 'active' : ' ' }}" href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span>
                                Comptoir</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('ventes.mesventes') }}"  class="{{ \Request::route()->getName() == 'ventes.mesventes' || \Request::route()->getName() == 'ventes.show' ? 'active' : ' ' }}">Mes Ventes</a></li>
                            <li><a href="{{ route('ventes.createcomptoir') }}"  class="{{ \Request::route()->getName() == 'ventes.createcomptoir'  ? 'active' : ' ' }}">Comptoir</a></li>
                        </ul>
                    </li>
                @endcan
                @can('admin')
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                                Utilisateurs</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('utilisateur.create') }}">Nouveau Utilisateur </a></li>
                            <li><a href="{{ route('utilisateur.index') }}">Liste Utilisateurs</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class=" {{ $segment1 == 'societes' ? 'active' : ' ' }}" href="javascript:void(0);"><img
                                src="assets/img/icons/settings.svg" alt="img"><span>
                                Parametre</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('societes.create') }}"
                                    class="{{ \Request::route()->getName() == 'societes.create' ? 'active' : ' ' }}">Entreprises</a>
                            </li>
                        </ul>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
