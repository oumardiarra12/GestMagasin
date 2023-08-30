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
        <h1>La Liste des Achats</h1>
        <div>
          <table  id="customers">
            <thead>
              <tr>
                <th>Fournisseur</th>
                <th>Reference</th>
                <th>Date</th>
                <th>Status Reception</th>
                <th>Total</th>
                <th>Retour</th>
                <th>Paiement</th>
                <th>Creer Par</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($achats as $achat)
              <tr>
                <td>
                    {{$achat->fournisseur->nom_fournisseur}}  {{$achat->fournisseur->prenom_fournisseur}}
                </td>
                <td>{{$achat->num_achat}}</td>
                <td>{{$achat->date_achat}}</td>
                <td> @if ($achat->status_achat_reception == 'encours')
                    <span class="rouge">En Cours</span>
                @elseif ($achat->status_achat_reception == 'reception partial')
                    <span class="jaune">Reception Partial</span>
                @else
                    <span class="vert">Reception</span>
                @endif
            </td>
                <td>{{$achat->total_achat}}</td>
                <td>{{ $achat->retourachats->sum('total_retour_achat') }}</td>
                <td>
                    @if ($achat->status_achat_payment =='no pay')
                    <span class="rouge">Non Payer</span>
                @elseif ($achat->status_achat_payment =='pay partial')
                    <span class="jaune">Payer Partial</span>
                @else
                    <span class="vert">Payer</span>
                @endif
                </td>
                <td>{{$achat->user->nom_user}} {{$achat->user->prenom_user}}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>

</body>
</html>
