<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
  {{-- <title>Ma première page avec du style</title> --}}
  <style type="text/css">
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

  </style>
</head>

<body>
    <div class="container">
        <h1>La Liste des Produits</h1>
        <div>
          <table  id="customers">
            <thead>
              <tr>
                <th>Ref</th>
                <th>Nom</th>
                <th>Code Bar</th>
                <th>Prix Vente</th>
                <th>Prix Achat</th>
                <th>Categorie</th>
                <th>Unite</th>
                <th>Stock Min</th>
                <th>Stock Actuel</th>
                <th>Saisir Par</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($produits as $produit)
              <tr>
                <td>
                    {{$produit->ref_produit}}
                </td>
                <td>{{$produit->nom_produit}}</td>
                <td>{{$produit->codebarre}}</td>
                <td>{{$produit->prixvente_produit}}</td>
                <td>{{$produit->prixachat_produit}}</td>
                <td>{{$produit->famille->nom_famille}}</td>
                <td>{{$produit->unite->nom_unite}}</td>
                <td>{{$produit->stockmin}}</td>
                <td>{{$produit->stockactuel}}</td>
                <td>{{$produit->user->nom_user}} {{$produit->user->prenom_user}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

</body>
</html>
