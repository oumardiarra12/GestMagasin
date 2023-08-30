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
              RETOUR ACHAT
            </td>
        </tr>
        <tr>
          <td height="10" style="font-size: 0px; line-height: 10px; height: 10px; padding: 0px;">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" style="font-family: sans-serif;" cellpadding="10">
        <tr>
            <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Fournisseur</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->achat->fournisseur->nom_fournisseur}} {{$achatretour->achat->fournisseur->prenom_fournisseur}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->achat->fournisseur->email_fournisseur}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->achat->fournisseur->tel_fournisseur}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->achat->fournisseur->adresse_fournisseur}}</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Societe</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$societe->nom_societe}} </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$societe->tel_societe}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$societe->adresse}}</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:18px;color:#7367F0;font-weight:600;line-height: 35px; ">Achat</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Ref. Achat </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Date</font></font><br>
                 <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Ref. Retour Achat</font></font><br>
                </td>
                <td style="padding:5px;vertical-align:top;text-align:right;padding-bottom:20px">
                <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">&nbsp;</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">{{$achatretour->achat->num_achat}} </font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->date_retour_achat}}</font></font><br>
                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> {{$achatretour->num_retour_achat}}</font></font><br>
                </td>
        </tr>
    </table>
    <br>

    <br>
    <table class="items" width="100%" style="font-size: 14px; border-collapse: collapse;" cellpadding="8">
        <thead>
            <tr>
                <td width="40%" style="text-align: left;"><strong>Designation</strong></td>
                <td width="20%" style="text-align: left;"><strong>QTE</strong></td>
                <td width="20%" style="text-align: left;"><strong>Prix Achat</strong></td>
                <td width="20%" style="text-align: left;"><strong>Sous Total</strong></td>
            </tr>
        </thead>
        <tbody>
            <!-- ITEMS HERE -->
            @foreach ($ligneachatretours as $ligneachatretour)
            <tr>
                <td>{{$ligneachatretour->produit->nom_produit}}</td>
                <td>{{$ligneachatretour->quantite_retourligneAchat}}</td>
                <td>{{$ligneachatretour->prixachat_retourligneAchat}}</td>
                <td>{{$ligneachatretour->soustotal_retourligneAchat}}</td>
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
                        <td style="border: 1px #eee solid; padding: 0px 8px; line-height: 20px;">{{$achatretour->total_retour_achat}}</td>
                    </tr>

                </table>
                <table>
                    <tr>
                        <td style="line-height: 20px;"><strong>Description</strong></td>
                    </tr>
                    <tr><td>{{$achatretour->description_retour_achat}}</td></tr>
                </table>
            </td>
        </tr>
    </table>
    <br>

</body>
</html>
