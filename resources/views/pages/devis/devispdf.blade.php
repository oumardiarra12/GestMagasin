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
        <h1>La Liste des Devis</h1>
        <div>
          <table  id="customers">
            <thead>
              <tr>
                <th>Client</th>
                <th>Reference</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Creer Par</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($devis as $devis)
              <tr>
                <td>
                    {{$devis->client->nom_client}}  {{$devis->client->prenom_client}}
                </td>
                <td>{{$devis->num_devis}}</td>
                <td>{{$devis->date_devis}}</td>
                <td>{{$devis->total_devis}}</td>
                <td>
                    @if ($devis->status_devis =='non accepter')
                    <span class="rouge">Non Accepter</span>
                @else
                    <span class="vert">Accepter</span>
                @endif
                </td>
                <td>{{$devis->user->nom_user}} {{$devis->user->prenom_user}}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>

</body>
</html>
