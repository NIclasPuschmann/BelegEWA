<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bestellung</title>
    </head>
    <body>

    <?php 

        $prod1_price=25.4; //self-php
        $prod2_price=18.0; //PHP-referenz
        $prod3_price=39.0; //php-kochbuch
        $prod1_weight=800; //self-php
        $prod2_weight=600; //PHP-referenz
        $prod3_weight=1300; //php-kochbuch
        $tax = 1.05;

        //Preisberechnung
        $price_brutto = $prod1_price * $_POST["offer1"];
        $price_brutto += $prod2_price * $_POST["offer2"];
        $price_brutto += $prod3_price * $_POST["offer3"];

        //Gewichtsberechnung
        $comp_weight = $prod1_weight * $_POST["offer1"];
        $comp_weight += $prod2_weight * $_POST["offer2"];
        $comp_weight += $prod3_weight * $_POST["offer3"];

        $price_brutto *= $tax;

        //Versandkostenfrei
        if($price_brutto >= 100) {
            $price_brutto+=0;
        }  
        
        else {

            //Versandkosten
            if($comp_weight >= 0 && $comp_weight <=2000) {
                $price_brutto+= 4.99;
            }
            if($comp_weight > 2000  && $comp_weight <=5000) {
                $price_brutto+= 5.99;
            }
            if($comp_weight > 5000 && $comp_weight <=10000) {
                $price_brutto+= 8.99;
            }
            if($comp_weight > 10000 && $comp_weight <=31000) {
                $price_brutto+= 16.08;
            }
        }

        echo "<p>Gesamtsumme: $price_brutto $</p>"
    ?>

    </body>
</html>