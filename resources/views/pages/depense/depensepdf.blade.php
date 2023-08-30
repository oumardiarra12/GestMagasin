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
        <h1>La Liste des Depenses</h1>
        <div>
            <table id="customers">
                <thead>
                    <tr>
                        <th>Ref Depense</th>
                        <th>Categorie </th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Creer Par</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depenses as $depense)
                        <tr>
                            <td>
                                {{ $depense->num_depense }}
                            </td>
                            <td>{{ $depense->categoriedepense->nom_categorie_depense }} </td>
                            <td>{{ $depense->date_depense }}</td>
                            <td>{{ $depense->total_depense }}</td>
                            <td>{{ $depense->user->nom_user }} {{ $depense->user->prenom_user }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
