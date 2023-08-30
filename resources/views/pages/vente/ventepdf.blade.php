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
.rouge{
    background-color: red;
    color: white;
    padding: 5px;
    border-radius: 5px;
}
.jaune{
    background-color: yellow;
    color: white;
    padding: 5px;
    border-radius: 5px;
}
.vert{
    background-color: green;
    color: white;
    padding: 5px;
    border-radius: 5px;
}
  </style>
</head>

<body>
    <div class="container">
        <h1>La Liste des Ventes</h1>
        <div>
          <table  id="customers">
            <thead>
              <tr>
                <th>Client</th>
                <th>Reference</th>
                <th>Date</th>
                <th>Total</th>
                <th>Retour</th>
                <th>Paiement</th>
                <th>Creer Par</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ventes as $vente)
              <tr>
                <td>
                    {{$vente->client->nom_client}}  {{$vente->client->prenom_client}}
                </td>
                <td>{{$vente->num_vente}}</td>
                <td>{{$vente->date_vente}}</td>
                <td>{{$vente->total_vente}}</td>
                <td>{{ $vente->retourventes->sum('total_retour_vente') }}</td>
                <td>
                    @if ($vente->status_vente_payment =='non payer')
                    <span class="rouge">Non Payer</span>
                @elseif ($vente->status_vente_payment =='payer partial')
                    <span class="jaune">Payer Partial</span>
                @else
                    <span class="vert">Payer</span>
                @endif
                </td>
                <td>{{$vente->user->nom_user}} {{$vente->user->prenom_user}}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>

</body>
</html>
