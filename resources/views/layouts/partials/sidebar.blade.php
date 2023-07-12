@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
@endphp
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li
                    class=" {{ \Request::route()->getName() == 'home.index' || \Request::route()->getName() == 'home.homegerant' || \Request::route()->getName() == 'home.user' ? 'active' : ' ' }}">
                    @if(Auth::user()->CategoryUser->name_category_users==='admin')
                        <a href="{{ route('home.index') }}"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                Dashboard</span>
                        </a>
                    @endif
                    @if(Auth::user()->CategoryUser->name_category_users==='gerant')
                        <a href="{{ route('home.homegerant') }}"><img src="assets/img/icons/dashboard.svg"
                                alt="img"><span> Dashboard</span>
                        </a>
                    @endif
                    @if(Auth::user()->CategoryUser->name_category_users==='gestionnaire')
                        <a href="{{ route('home.user') }}"><img src="assets/img/icons/dashboard.svg" alt="img"><span>
                                Dashboard</span>
                        </a>
                    @endif
                </li>
                @if(Auth::user()->CategoryUser->name_category_users==='admin' || Auth::user()->CategoryUser->name_category_users==='gerant' )
                <li class="submenu">
                    <a class=" {{ $segment1 == 'categories' || $segment1 == 'unites' || $segment1 == 'produits' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                            Gestion Produit</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('produits.index') }}"
                                class="{{ \Request::route()->getName() == 'produits.index' || \Request::route()->getName() == 'produits.show' || \Request::route()->getName() == 'produits.edit' ? 'active' : ' ' }}">Liste
                                de Produit</a></li>
                        <li><a href="{{ route('produits.createproduct') }}"
                                class="{{ \Request::route()->getName() == 'produits.createproduct' ? 'active' : ' ' }}">Nouveau
                                Produit</a></li>
                        <li><a href="{{ route('produits.importproduit') }}"
                                class="{{ \Request::route()->getName() == 'produits.importproduit' ? 'active' : ' ' }}">Import
                                Produits</a></li>
                        <li><a href="{{ route('produits.listecodebarre') }}"
                                class="{{ \Request::route()->getName() == 'produits.listecodebarre' ? 'active' : ' ' }}">Imprimer
                                code Barre</a></li>
                        <li><a href="{{ route('categories.index') }}"
                                class="{{ \Request::route()->getName() == 'categories.index' || \Request::route()->getName() == 'categories.create' || \Request::route()->getName() == 'categories.show' || \Request::route()->getName() == 'categories.edit' ? 'active' : ' ' }}">Categorie</a>
                        </li>
                        <li><a href="{{ route('unites.index') }}"
                                class="{{ \Request::route()->getName() == 'unites.index' || \Request::route()->getName() == 'unites.create' || \Request::route()->getName() == 'unites.show' || \Request::route()->getName() == 'unites.edit' ? 'active' : ' ' }}">Unite</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->CategoryUser->name_category_users==='admin' || Auth::user()->CategoryUser->name_category_users==='gerant' || Auth::user()->CategoryUser->name_category_users==='gestionnaire' )
                <li class="submenu">
                    <a class="{{ $segment1 == 'clients' ? 'active' : ' ' }}" href="javascript:void(0);"><img
                            src="assets/img/icons/users1.svg" alt="img"><span>
                            Gestion Client</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('clients.index') }}"
                                class="{{ \Request::route()->getName() == 'clients.index' || \Request::route()->getName() == 'clients.show' || \Request::route()->getName() == 'clients.edit' ? 'active' : ' ' }}">Liste
                                Client</a></li>
                        <li><a href="{{ route('clients.createclient') }}"
                                class="{{ \Request::route()->getName() == 'clients.createclient' ? 'active' : ' ' }}">Nouveau
                                Client</a></li>
                        <li><a href="{{ route('clients.importclient') }}"
                                class="{{ \Request::route()->getName() == 'clients.importclient' ? 'active' : ' ' }}">Import
                                Client</a></li>
                    </ul>
                </li>
                @endif
                @if(Auth::user()->CategoryUser->name_category_users==='gestionnaire' )
                <li><a href="{{ route('comptoirs.create') }}"
                    class="{{ \Request::route()->getName() == 'comptoirs.create' ? 'active' : ' ' }}">Comptoir</a></li>
                @endif
                @if(Auth::user()->CategoryUser->name_category_users==='admin' || Auth::user()->CategoryUser->name_category_users==='gerant' )
                <li class="submenu">
                    <a class="{{ $segment1 == 'commandeventes' || $segment1 == 'livraisons' || $segment1 == 'devis' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span>
                            Gestion Ventes</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('commandeventes.index') }}"
                                class="{{ \Request::route()->getName() == 'commandeventes.index' || \Request::route()->getName() == 'commandeventes.show' || \Request::route()->getName() == 'commandeventes.edit' ? 'active' : ' ' }}">Liste
                                Commande</a></li>
                        <li><a href="{{ route('commandeventes.createcmdvente') }}"
                                class="{{ \Request::route()->getName() == 'commandeventes.createcmdvente' ? 'active' : ' ' }}">Nouveau
                                Commande</a></li>
                        <li><a href="{{ route('livraisons.index') }}"
                                class="{{ \Request::route()->getName() == 'livraisons.index' || \Request::route()->getName() == 'livraisons.show' || \Request::route()->getName() == 'livraisons.edit' ? 'active' : ' ' }}">Liste
                                Livraison</a></li>
                        <li><a href="{{ route('livraisons.createlivraison') }}"
                                class="{{ \Request::route()->getName() == 'livraisons.createlivraison' ? 'active' : ' ' }}">Nouveau
                                Livraison</a></li>
                        <li><a href="{{ route('devis.index') }}"
                                class="{{ \Request::route()->getName() == 'devis.index' || \Request::route()->getName() == 'devis.show' || \Request::route()->getName() == 'devis.edit' ? 'active' : ' ' }}">Liste
                                Devis</a></li>
                        <li><a href="{{ route('devis.create') }}"
                                class="{{ \Request::route()->getName() == 'devis.create' ? 'active' : ' ' }}">Nouveau
                                Devis</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a class="{{ $segment1 == 'fournisseurs' ? 'active' : ' ' }}" href="javascript:void(0);"><img
                            src="assets/img/icons/users1.svg" alt="img"><span>
                            Gestion Fournisseur</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('fournisseurs.index') }}"
                                class="{{ \Request::route()->getName() == 'fournisseurs.index' || \Request::route()->getName() == 'fournisseurs.show' || \Request::route()->getName() == 'fournisseurs.edit' ? 'active' : ' ' }}">Liste
                                Fournisseur</a></li>
                        <li><a href="{{ route('fournisseurs.createfournisseur') }}"
                                class="{{ \Request::route()->getName() == 'fournisseurs.createfournisseur' ? 'active' : ' ' }}">Nouveau
                                Fournisseur</a></li>
                        <li><a href="{{ route('fournisseurs.importfournisseur') }}"
                                class="{{ \Request::route()->getName() == 'fournisseurs.importfournisseur' ? 'active' : ' ' }}">Import
                                Fournisseur</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ $segment1 == 'commandeachats' || $segment1 == 'receptions' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span>
                            Commande Achat</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('commandeachats.index') }}"
                                class="{{ \Request::route()->getName() == 'commandeachats.index' || \Request::route()->getName() == 'commandeachats.show' || \Request::route()->getName() == 'commandeachats.edit' ? 'active' : ' ' }}">Liste
                                Commande</a></li>
                        <li><a href="{{ route('commandeachats.createcmdachat') }}"
                                class="{{ \Request::route()->getName() == 'commandeachats.createcmdachat' ? 'active' : ' ' }}">Nouveau
                                Commande</a></li>
                        <li><a href="{{ route('receptions.index') }}"
                                class="{{ \Request::route()->getName() == 'receptions.index' || \Request::route()->getName() == 'receptions.show' || \Request::route()->getName() == 'receptions.edit' ? 'active' : ' ' }}">Liste
                                Reception</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ $segment1 == 'achatfactures' || $segment1 == 'ventefactures' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/purchase1.svg" alt="img"><span>
                            Gestion des Factures</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('achatfactures.index') }}"
                                class="{{ \Request::route()->getName() == 'achatfactures.index' || \Request::route()->getName() == 'achatfactures.show' || \Request::route()->getName() == 'achatfactures.edit' ? 'active' : ' ' }}">Facture
                                Achat</a></li>
                        <li><a href="{{ route('ventefactures.index') }}"
                                class="{{ \Request::route()->getName() == 'ventefactures.index' || \Request::route()->getName() == 'ventefactures.show' || \Request::route()->getName() == 'ventefactures.edit' ? 'active' : ' ' }}">Facture
                                Vente</a></li>
                        {{-- <li><a href="{{route('retournachats.index')}}" class="{{ $segment1 == 'retournachats'  ? 'active' : ' ' }}">Retourn Achat</a></li> --}}
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ $segment1 == 'retournachats' || $segment1 == 'retournventes' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span>
                            Gestion des Retours</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('retournachats.index') }}"
                                class="{{ \Request::route()->getName() == 'retournachats.index' || \Request::route()->getName() == 'retournachats.show' || \Request::route()->getName() == 'retournachats.edit' ? 'active' : ' ' }}">Retourn
                                Achat</a></li>
                        <li><a href="{{ route('retournventes.index') }}"
                                class="{{ \Request::route()->getName() == 'retournventes.index' || \Request::route()->getName() == 'retournventes.show' || \Request::route()->getName() == 'retournventes.edit' ? 'active' : ' ' }}">Retourn
                                Vente</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a class="{{ $segment1 == 'typedepenses' || $segment1 == 'depenses' || $segment1 == 'typedepenses' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/expense1.svg" alt="img"><span>
                            Gestion Depense</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('depenses.index') }}"
                                class="{{ \Request::route()->getName() == 'depenses.index' || \Request::route()->getName() == 'depenses.show' || \Request::route()->getName() == 'depenses.edit' ? 'active' : ' ' }}">Liste
                                Depense</a></li>
                        <li><a href="{{ route('depenses.create') }}"
                                class="{{ \Request::route()->getName() == 'depenses.create' ? 'active' : ' ' }}">Nouveau
                                Depense</a></li>
                        <li><a href="{{ route('typedepenses.index') }}"
                                class="{{ \Request::route()->getName() == 'typedepenses.index' || \Request::route()->getName() == 'typedepenses.show' || \Request::route()->getName() == 'typedepenses.edit' || \Request::route()->getName() == 'typedepenses.create' ? 'active' : ' ' }}">Categorie
                                Depense</a></li>
                    </ul>
                </li>
                @endif
                {{-- <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/quotation1.svg" alt="img"><span>
                            Quotation</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="quotationList.html">Quotation List</a></li>
                        <li><a href="addquotation.html">Add Quotation</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/transfer1.svg" alt="img"><span>
                            Transfer</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="transferlist.html">Transfer List</a></li>
                        <li><a href="addtransfer.html">Add Transfer </a></li>
                        <li><a href="importtransfer.html">Import Transfer </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/return1.svg" alt="img"><span>
                            Return</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="salesreturnlist.html">Sales Return List</a></li>
                        <li><a href="createsalesreturn.html">Add Sales Return </a></li>
                        <li><a href="purchasereturnlist.html">Purchase Return List</a></li>
                        <li><a href="createpurchasereturn.html">Add Purchase Return </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                            People</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="customerlist.html">Customer List</a></li>
                        <li><a href="addcustomer.html">Add Customer </a></li>
                        <li><a href="supplierlist.html">Supplier List</a></li>
                        <li><a href="addsupplier.html">Add Supplier </a></li>
                        <li><a href="userlist.html">User List</a></li>
                        <li><a href="adduser.html">Add User</a></li>
                        <li><a href="storelist.html">Store List</a></li>
                        <li><a href="addstore.html">Add Store</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/places.svg" alt="img"><span>
                            Places</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="newcountry.html">New Country</a></li>
                        <li><a href="countrieslist.html">Countries list</a></li>
                        <li><a href="newstate.html">New State </a></li>
                        <li><a href="statelist.html">State list</a></li>
                    </ul>
                </li>
                <li>
                    <a href="components.html"><i data-feather="layers"></i><span> Components</span> </a>
                </li>
                <li>
                    <a href="blankpage.html"><i data-feather="file"></i><span> Blank Page</span> </a>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="alert-octagon"></i> <span> Error Pages </span>
                        <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="error-404.html">404 Error </a></li>
                        <li><a href="error-500.html">500 Error </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="box"></i> <span>Elements </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="sweetalerts.html">Sweet Alerts</a></li>
                        <li><a href="tooltip.html">Tooltip</a></li>
                        <li><a href="popover.html">Popover</a></li>
                        <li><a href="ribbon.html">Ribbon</a></li>
                        <li><a href="clipboard.html">Clipboard</a></li>
                        <li><a href="drag-drop.html">Drag & Drop</a></li>
                        <li><a href="rangeslider.html">Range Slider</a></li>
                        <li><a href="rating.html">Rating</a></li>
                        <li><a href="toastr.html">Toastr</a></li>
                        <li><a href="text-editor.html">Text Editor</a></li>
                        <li><a href="counter.html">Counter</a></li>
                        <li><a href="scrollbar.html">Scrollbar</a></li>
                        <li><a href="spinner.html">Spinner</a></li>
                        <li><a href="notification.html">Notification</a></li>
                        <li><a href="lightbox.html">Lightbox</a></li>
                        <li><a href="stickynote.html">Sticky Note</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="form-wizard.html">Form Wizard</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="bar-chart-2"></i> <span> Charts </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="chart-apex.html">Apex Charts</a></li>
                        <li><a href="chart-js.html">Chart Js</a></li>
                        <li><a href="chart-morris.html">Morris Charts</a></li>
                        <li><a href="chart-flot.html">Flot Charts</a></li>
                        <li><a href="chart-peity.html">Peity Charts</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="award"></i><span> Icons </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
                        <li><a href="icon-feather.html">Feather Icons</a></li>
                        <li><a href="icon-ionic.html">Ionic Icons</a></li>
                        <li><a href="icon-material.html">Material Icons</a></li>
                        <li><a href="icon-pe7.html">Pe7 Icons</a></li>
                        <li><a href="icon-simpleline.html">Simpleline Icons</a></li>
                        <li><a href="icon-themify.html">Themify Icons</a></li>
                        <li><a href="icon-weather.html">Weather Icons</a></li>
                        <li><a href="icon-typicon.html">Typicon Icons</a></li>
                        <li><a href="icon-flag.html">Flag Icons</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="columns"></i> <span> Forms </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                        <li><a href="form-input-groups.html">Input Groups </a></li>
                        <li><a href="form-horizontal.html">Horizontal Form </a></li>
                        <li><a href="form-vertical.html"> Vertical Form </a></li>
                        <li><a href="form-mask.html">Form Mask </a></li>
                        <li><a href="form-validation.html">Form Validation </a></li>
                        <li><a href="form-select2.html">Form Select2 </a></li>
                        <li><a href="form-fileupload.html">File Upload </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="layout"></i> <span> Table </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="tables-basic.html">Basic Tables </a></li>
                        <li><a href="data-tables.html">Data Table </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span>
                            Application</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="chat.html">Chat</a></li>
                        <li><a href="calendar.html">Calendar</a></li>
                        <li><a href="email.html">Email</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/time.svg" alt="img"><span>
                            Report</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="purchaseorderreport.html">Purchase order report</a></li>
                        <li><a href="inventoryreport.html">Inventory Report</a></li>
                        <li><a href="salesreport.html">Sales Report</a></li>
                        <li><a href="invoicereport.html">Invoice Report</a></li>
                        <li><a href="purchasereport.html">Purchase Report</a></li>
                        <li><a href="supplierreport.html">Supplier Report</a></li>
                        <li><a href="customerreport.html">Customer Report</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="assets/img/icons/users1.svg" alt="img"><span>
                            Users</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="newuser.html">New User </a></li>
                        <li><a href="userlists.html">Users List</a></li>
                    </ul>
                </li> --}}
                @if(Auth::user()->CategoryUser->name_category_users==='admin' )
                <li class="submenu">
                    <a class="{{ $segment1 == 'utilisateur' || $segment1 == 'companies' ? 'active' : ' ' }}"
                        href="javascript:void(0);"><img src="assets/img/icons/settings.svg" alt="img"><span>
                            Parametres</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('companies.create') }}"
                                class="{{ \Request::route()->getName() == 'companies.create' ? 'active' : ' ' }}">Parametre
                                Societe</a></li>
                        <li><a href="{{ route('utilisateur.index') }}"
                                class="{{ \Request::route()->getName() == 'utilisateur.index' || \Request::route()->getName() == 'utilisateur.show' || \Request::route()->getName() == 'utilisateur.edit' ? 'active' : ' ' }}">Liste
                                Utilisateur</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
