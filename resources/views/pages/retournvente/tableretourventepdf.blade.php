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
        <h1>La Liste des Retours Ventes </h1>
        <div>
          <table  id="customers">
            <thead>
              <tr>
                <th>Date</th>
                <th>Client</th>
                <th>Ref. Vente</th>
                <th>Ref. Vente Retour</th>
                <th>Total</th>
                <th>Creer Par</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($venteretours as $venteretour)
              <tr>
                <td>{{$venteretour->date_retourvente}}</td>
                <td>
                    {{$venteretour->vente->client->nom_client}}  {{$venteretour->vente->client->prenom_client}}
                </td>
                <td>{{$venteretour->vente->num_vente}}</td>

                <td>{{$venteretour->num_retourvente}}</td>
            </td>
                <td>{{$venteretour->total_retourvente}}</td>

                <td>{{$venteretour->user->nom_user}} {{$venteretour->user->prenom_user}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

</body>
</html>
