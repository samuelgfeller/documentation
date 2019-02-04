<head>
    <meta charset="utf-8">
    <title>Rechnung</title>
    <base href="<?php echo baseurl('/', true) ?>">

</head>
<body>
<style>
    /*Page*/
    body {
        width: 210mm;
        min-height: 296.5mm;
        margin: 0;
        padding: 0;
        font-family: Helvetica, sans-serif;
        font-size: 12pt;
    }
    * {
        font-size:10pt;
        box-sizing: border-box;
    }
    .page {
        width:100%;
        min-height: 100%;
        /*padding: 20mm;*/
        background: white;
    }
    .subpage {
        /*padding: 1cm;*/
        padding: 1cm 1.5cm 0 1cm;
        height:100%;
        /*outline: 3px black solid;*/
    }
    @page {
        size: A4;
        margin: 0;
    }


    /*Table*/
    #billTable{
        width:100%;
    }
    .numberTd{
        text-align: center;
        width:13%;
    }
    .weightTd{
        text-align: center;
        width:20%;
    }
    .nameTd{
        text-align: left;
        width: 170px;
        min-width: 100px;
    }
    .kgPriceTd{
        text-align: right;
        width:15%;
    }
    .priceTd{
        text-align: right;
    }
    .totalTr {
        text-align: right;
        height: 70px;
        /*width:auto;*/
    }
    /*Image*/
    #esrImg{
        width:100%;
        position: absolute;
        z-index: 1;
        left: 0;
        bottom: 0;

    }
    #demeterLogo{
        width:100px;
        float: left;
    }
    #masesselinLogo{
        width:100px;
        float: left;
    }

    /*Article*/
    #articleDiv{
        min-height: 510px;
        max-height: 510px;
    }
    /*Text*/
    #ownAddress{
        float: left;
        margin:0 0 0 13px;
    }
    #customerAddress{
        float: right;
        margin-right: 20px;
    }
    #title{
        margin-top:16%;
        margin-bottom: 3%;
        /*margin-left:10%;*/
        font-size:16pt;
    }
    /*ESR*/
    #ownAddressEsr1,#ownAddressEsr2,#bankNr1,#bankNr2,#dateNr, #customerAddressEsr1, #customerAddressEsr2{
        z-index: 2;
        position: absolute;
    }
    #ownAddressEsr1{
        margin:8% 0 0 0;
    }
    #ownAddressEsr2{
        margin:8% 0 0 28%;
    }
    #bankNr1{
        margin:23% 0 0 9%;
    }
    #bankNr2{
        margin:23% 0 0 38%;
    }
    #dateNr{
        margin:8% 0 0 55%;
    }
    #customerAddressEsr1{
        margin: 33% 0 0 0;

    }
    #customerAddressEsr2{
        margin:27% 0 0 55%;
    }

</style>
<div class="page">
    <div class="subpage">
        <img src="https://i.imgur.com/49Esa1E.png" id="demeterLogo" alt="logo">
        <p id="ownAddress">
            Nicolas Barth<br>
            Masesselin 81<br>
            2887 Soubey<br>
            032 955 17 04<br>
        </p>
        <img src="https://i.imgur.com/wCVp0bb.jpg" id="masesselinLogo" alt="logo">
        <p id="customerAddress">
            <?php
            echo $client->getName() . '<br>' . $client->getFirstName() . '<br>';
            if (!empty($client->getAddress())) {
                echo $client->getAddress() . '<br>';
            }
            if (!empty($place)) {
                echo $place->getZip() . ' ' . $place->getPlace();
            }
            ?>
        </p>
        <p id="title">
            Rechnung vom <?php echo date('j.n.Y') ?>
        </p>
        <div id="articleDiv">

            <table id="billTable">
                <tr>
                    <th class='numberTd'></th>
                    <th class='weightTd'>Kg</th>
                    <th class='nameTd'>Artikel</th>
                    <th class='kgPriceTd'>CHF / Kg</th>
                    <th class='priceTd' colspan="2">Total</th>
                </tr>
                <?php
                $totalPrice = 0;
                $totalWeight = 0;
                foreach ($scans as $scan) {
                    echo "<tr><td class='numberTd'>" . $scan['number'] . "</td>
                         <td class='weightTd'>" . $scan['weight'] . "</td>
                         <td class='nameTd' class='min'>" . $scan['name'] . "</td>
                         <td class='kgPriceTd'>" . $scan['kgPrice'] . "</td>
                         <td class='priceTd'>" . number_format($scan['price'], 2) . "</td></tr>
                    ";
                    $totalPrice += $scan['price'];
                    $totalWeight += $scan['weight']; /*  number_format(\"$totalPrice\",2)*/
                }
                echo "<tr class='totalTr' >
                        <td>&nbsp;</td>
                        <td style='text-align: center'>" . $totalWeight . " Kg</td>
                        <td>&nbsp;</td>
                        <td colspan='' >Summe Total:</td>
                        <td><b>" . number_format(floor($totalPrice * 20) / 20, 2) . "</b></td>
                      
                      </tr>";
                ?>
            </table>
        </div>
        <img id="esrImg" src="https://i.imgur.com/GNSZBeH.png" alt="logo">
        <p id="ownAddressEsr1">
            Nicolas Barth <br>
            Masseselin<br>
            2887 Soubey<br>
        </p>
        <p id="ownAddressEsr2">
            Nicolas Barth<br>
            Masseselin<br>
            2887 Soubey<br>
        </p>
        <p id="bankNr1">10-781784-0</p>
        <p id="bankNr2">10-781784-0</p>
        <p id="dateNr">
            <?php echo date('j.n.Y') . '<br>' . $billId; ?>
        </p>
        <p id="customerAddressEsr1">
            <?php
            echo $client->getName() . '<br>' . $client->getFirstName() . '<br>';
            if (!empty($client->getAddress())) {
                echo $client->getAddress() . '<br>';
            }
            if (!empty($place)) {
                echo $place->getZip() . ' ' . $place->getPlace();
            }
            ?>
        </p>
        <p id="customerAddressEsr2">
            <?php
            echo $client->getName() . '<br>' . $client->getFirstName() . '<br>';
            if (!empty($client->getAddress())) {
                echo $client->getAddress() . '<br>';
            }
            if (!empty($place)) {
                echo $place->getZip() . ' ' . $place->getPlace();
            }
            ?>
        </p>

    </div>
</div>
</body>
</html>
