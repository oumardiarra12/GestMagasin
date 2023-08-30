<html>
<head>
    <style>
    body {
        font-family: sans-serif;
        font-size: 10pt;
    }

    p {
        margin: 0pt;
    }

    table.items {
        border: 0.1mm solid #e7e7e7;
    }

    td {
        vertical-align: top;
    }

    .items td {
        border-left: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    table thead td {
        text-align: center;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #e7e7e7;
        background-color: #FFFFFF;
        border: 0mm none #e7e7e7;
        border-top: 0.1mm solid #e7e7e7;
        border-right: 0.1mm solid #e7e7e7;
    }

    .items td.totals {
        text-align: right;
        border: 0.1mm solid #e7e7e7;
    }

    .items td.cost {
        text-align: "."center;
    }
    </style>
</head>

<body>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td width="100%" style="padding: 0px; text-align: center;">
              <a href="#"><img src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/logosociete/' . $societe->logo_societe))); ?>" width="264" height="110" alt="Logo" align="center" border="0"></a>
            </td>
        </tr>
        <tr>
            <td width="100%" style="text-align: center; font-size: 20px; font-weight: bold; padding: 0px;">
              Devis
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Client</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$devis->client->nom_client}} {{$devis->client->prenom_client}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$devis->client->email_client}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$devis->client->tel_client}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$devis->client->adresse_client}}</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Societe</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$societe->nom_societe}} </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$societe->tel_societe}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$societe->adresse}}</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Achat</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Reference </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Date</font></font><br>
                 <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Status</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">&nbsp;</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$devis->num_devis}} </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$devis->date_devis}}</font></font><br>
                @if ($devis->status_devis=="non accepter")
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#e92208;font-weight: 400;"> {{$devis->status_devis}}</font></font><br>
                    @else
                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;"> {{$vente->status_devis}}</font></font><br>
                @endif

                </td>
        </tr>
    </table>
    <br>

    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="45%" style="text-align: left;"><strong>Designation</strong></td>
                <td width="15%" style="text-align: left;"><strong>QTE</strong></td>
                <td width="20%" style="text-align: left;"><strong>Prix Vente</strong></td>
                <td width="20%" style="text-align: left;"><strong>Sous Total</strong></td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            @foreach ($lignedevis as $lignedevis)
            <tr>
                <td>{{$lignedevis->produit->nom_produit}}</td>
                <td>{{$lignedevis->quantite_lignedevis}}</td>
                <td>{{$lignedevis->prixvente_lignedevis}}</td>
                <td>{{$lignedevis->soustotal_lignedevis}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
    <br>
    <table width="100%" style="font-family: sans-serif; font-size: 14px;" >
        <tr>
            <td>
                <table width="60%" align="left" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="padding: 0px; line-height: 20px;">&nbsp;</td>
                    </tr>
                </table>
                <table width="40%" align="right" style="font-family: sans-serif; font-size: 14px;" >
                    <tr>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;"><strong>Total</strong></td>
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$devis->total_devis}}</td>
                    </tr>

                </table>
                <table>
                    <tr>
                        <td style="line-height: 20px;"><strong>Description</strong></td>
                    </tr>
                    <tr><td>{{$devis->description_devis}}</td></tr>
                </table>
            </td>
        </tr>
    </table>
    <br>

</body>
</html>
