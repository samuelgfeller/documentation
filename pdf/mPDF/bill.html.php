<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rechnung</title>
    <base href="<?php echo baseurl('/', true) ?>">

</head>
<body>

<!-- Failed because minwidth on the div above the esr didn't work so the data on the ESR kept moving -->

<style>
    /*Page*/
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
        color: black;
        /*line-height: 0.3em !* mPDF makes too much space between lines *!;*/
    }

    .page {
        width: 210mm;
        min-height: 297mm;
    }

    .subpage {
        /*padding: 1cm;*/
        padding: 1cm 1.5cm 0 1cm;
        height: 296.5mm;
    }

    /*Table*/
    .contentTable{
        width: 100%;
    }
    .contentTable tr{
        width: 100%;
    }

    #title {
        margin-top: 40px;

        /*margin-left:10%;*/
        font-size: 16pt;
    }

    #articleTr {
        min-height: 510px;
        max-height: 510px;
        width: 100%;
        background: #D3D3D3;
        border: 1px solid black;
        padding: 20px;
    }

    #billTable {
        width: 100%;
    }

    .numberTd {
        text-align: center;
        width: 13%;
    }

    .weightTd {
        text-align: center;
        width: 20%;
    }

    .nameTd {
        text-align: left;
        width: 200px;
        min-width: 100px;
    }

    .kgPriceTd {
        text-align: right;
        width: 15%;
    }

    .priceTd {
        text-align: right;
    }

    .totalTr {
        text-align: right;
        /*width:auto;*/
    }

    #headerTable {
        width: 100%;
        overflow: hidden;
    }

    .emptyPaddingTd {
        padding: 5px;
    }

    .alignRight {
        text-align: right;
    }

    /*Image*/
    #demeterLogo {
        width: 100px;
        /*float: left;*/
    }

    #masesselinLogo {
        width: 100px;
        margin: 0 0 0 18px;
    }

    /*Article*/


    /*Text*/
    #ownAddressTd {
        white-space: nowrap;
        padding-left: 18px;

    }

    #ownAddress {
    }

    #customerAddressTd {
        width: 99%;
        text-align: right;
    }

    #customerAddress {
        margin-right: 20px;
        right: 0;
        /*float: right;*/
    }



    /*ESR*/
    .esrData {
        /*width: 100%;*/
        /*position: absolute;*/
        /*margin-top: 100mm;*/

    }

    #ownAddressEsr1, #ownAddressEsr2, #bankNr1, #bankNr2, #dateNr, #customerAddressEsr1, #customerAddressEsr2 {
        z-index: 2;

    }

    #ownAddressEsr1 {
        top: 220mm;
        background: pink;
    }

    #ownAddressEsr2 {
        margin: 8% 0 0 28%;
    }

    #bankNr1 {
        margin: 23% 0 0 9%;
    }

    #bankNr2 {
        margin: 23% 0 0 38%;
    }

    #dateNr {
        margin: 8% 0 0 55%;
    }

    #customerAddressEsr1 {
        margin: 33% 0 0 0;

    }

    #customerAddressEsr2 {
        margin: 27% 0 0 55%;
    }

</style>


<div class="page">
    <div class="subpage">
        <table id="headerTable">
            <tr>
                <td>
                    <img src="images/logo_demeter.png" id="demeterLogo" alt="logo">
                </td>
                <td id="ownAddressTd">
                    <p id="ownAddress">
                        Nicolas Barth<br>
                        Masesselin 81<br>
                        2887 Soubey<br>
                        032 955 17 04<br>
                    </p>
                </td>
                <td>
                    <img src="images/logo.jpg" id="masesselinLogo" alt="logo">
                </td>
                <td id="customerAddressTd">
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
                </td>
            </tr>
        </table>
        <table class="contentTable" style="border:1px solid red;">
            <tr id="title" style="border:1px solid black;">
                <td colspan="3">
                    Rechnung vom <?php echo date('j.n.Y') ?>
                </td>
            </tr>
            <tr id="articleTr">
                <td colspan="3">
                    <table id="billTable" cellpadding="0.5">
                        <tr>
                            <th class='numberTd'></th>
                            <th class='weightTd'>Kg</th>
                            <th class='nameTd'>Artikel</th>
                            <th class='kgPriceTd'>CHF / Kg</th>
                            <th style="" class='priceTd'>Total</th>
                        </tr>
                        <?php $i = 1;
                        $totalPrice = 0;
                        $totalWeight = 0;
                        foreach ($scans as $scan) { ?>
                            <tr>
                                <td class='numberTd'><?= $scan['number'] ?></td>
                                <td class='weightTd'><?= $scan['weight'] ?></td>
                                <td class='nameTd' class='min'><?= $scan['name'] ?></td>
                                <td class='kgPriceTd'><?= $scan['kgPrice'] ?></td>
                                <td class='priceTd'><?= number_format($scan['price'], 2) ?></td>
                            </tr>
                            <?php
                            $totalPrice += $scan['price'];
                            $totalWeight += $scan['weight']; /*  number_format(\"$totalPrice\",2)*/
                            $i += 10;
                        }
                        ?>
                        <tr>
                            <td class='emptyPaddingTd'>
                        </tr>
                        <tr class='totalTr'>
                            <td>&nbsp;</td>
                            <td style='text-align: center'><?= $totalWeight ?> Kg</td>
                            <td>&nbsp;</td>
                            <td class="alignRight">Summe Total:</td>
                            <td class="alignRight"><b><?= number_format(floor($totalPrice * 20) / 20, 2) ?></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="esrData" style="border:1px solid black;min-height: 300px;">
                <!--        <img id="esrImg" src="images/es.png" alt="logo">-->
                <td id="ownAddressEsr1" style="border:1px solid black;">
                    Nicolas Barth <br>
                    Masseselin<br>
                    2887 Soubey<br>
                </td>
                <td id="ownAddressEsr2" style="border:1px solid black;">
                    Nicolas Barth<br>
                    Masseselin<br>
                    2887 Soubey<br>
                </td>
                <td id="dateNr" style="border:1px solid black;">
                    <?php echo date('j.n.Y') . '<br>' . $billId; ?>
                </td>
            </tr>
            <tr>
                <td id="bankNr1" style="border:1px solid black;">10-781784-0</td>
                <td id="bankNr2" style="border:1px solid black;">10-781784-0</td>
            </tr>
            <tr>
                <td id="customerAddressEsr1" style="border:1px solid black;">
                    <?php
                    /*                echo $client->getName() . '<br>' . $client->getFirstName() . '<br>';
                                    if (!empty($client->getAddress())) {
                                        echo $client->getAddress() . '<br>';
                                    }
                                    if (!empty($place)) {
                                        echo $place->getZip() . ' ' . $place->getPlace();
                                    }
                                    */ ?>
                </td>
                <td id="customerAddressEsr2" style="border:1px solid black;">
                    <?php
                    /*                echo $client->getName() . '<br>' . $client->getFirstName() . '<br>';
                                    if (!empty($client->getAddress())) {
                                        echo $client->getAddress() . '<br>';
                                    }
                                    if (!empty($place)) {
                                        echo $place->getZip() . ' ' . $place->getPlace();
                                    }
                                    */ ?>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
