<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
       ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

li {
    width: 250px;
    height: 100px;
    border: 1px solid #000;
  display: inline-block;
  margin: 10px; /* add spacing between items */
  padding: 10px 20px;

}
.card{
    padding: 5px;
}
span{
    padding: 0;
    margin: 0;
}
h3{
    padding: 0;
    margin: 0;
}
    </style>
</head>

<body>
        <ul>
        @foreach ($produits as $produit)
            <li>

                    <h3>{!! DNS1D::getBarcodeHTML($produit->codebarre, 'C39', 1) !!}</h3>
                    <span>{{ $produit->codebarre }}</span><br/>
                    <span>Nom: {{ $produit->nom_produit }}</span><br/>
                    <span>vente: {{ $produit->prixvente_produit }}</span>

            </li>
        @endforeach
    </ul>
</div>
</body>

</html>
