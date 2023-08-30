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

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

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
        <h1>La Liste des Fournisseur</h1>
        <div>
            <table id="customers">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Addresse</th>
                        {{-- <th>Saisir Par</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fournisseurs as $fournisseur)
                    <tr>
                        <td>
                           {{$fournisseur->nom_fournisseur}}
                        </td>
                        <td>{{$fournisseur->prenom_fournisseur}}</td>
                        <td>{{$fournisseur->email_fournisseur}}</td>
                        <td>{{$fournisseur->tel_fournisseur}}</td>
                        <td>{{$fournisseur->adresse_fournisseur}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
