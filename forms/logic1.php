<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Logic 1</title>
    <link type="text/css" rel="stylesheet" href="./css/styles.css">
</head>

<body>
<table>
        <tr>
            <th>Nummer</th>
            <th>Produkt</th>
        </tr>
<?php 
    $anzZeilen=10;
    for($x=1; $x<=10; $x++) {
        echo "<tr>
                <td>Nr. $x</td>
                <td>Produkt $x</td>
            </tr>";
    }
?>
</table>

</body>

</html>