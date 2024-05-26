<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Consulta Posición Cliente </title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body class="bodyStyle">

        <div id="header" class="mainHeader">
                <hr>
                <div class="center"> Inversiones de los Clientes </div>
        </div>
        <br>
        <hr>

<?php

// Create a connection to the database.

$db_url = "localhost";
$db_name = "inversiones";
$db_user = "porf";
$db_password = "adminadmin";

$conn = new mysqli($db_url, $db_user, $db_password, $db_name);

// Check the connection.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all investments in the database.

$sql = "Select cliente.nombre, apellido_pat, productos.nombre as producto, portafolio.titulos, productos.precio, FLOOR(portafolio.titulos*productos.precio) as Valor from productos,cliente, portafolio where productos.idprod=portafolio.idprod and cliente.idcte=portafolio.idcte";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // Display information for each order.

    $previousOrderNumber = 0;
    $firstTime = true;

     echo '<table style="width: 80%">';
     echo '<tr>';
     echo '<th>Nombre</th>';
     echo '<th>Apellido</th>';
     echo '<th>Producto</th>';
     echo '<th>Titulos</th>';
     echo '<th>Precio</th>';
     echo '<th>Valor</th>';
     echo '</tr>';

    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td align="center">' . $row["nombre"] . '</td>';
    	echo '<td align="center">' . $row["apellido_pat"] . '</td>';
    	echo '<td align="center">' . $row["producto"] . '</td>';
	echo '<td align="center">' . $row["titulos"] . '</td>';
        echo '<td align="center">' . $currency . $row["precio"]. '</td>';
        echo '<td align="center">' . $currency . number_format($row["Valor"], 2) . '</td>';
        echo '</tr>';

    }

} else {

    echo '<p class="center">You have no investments at this time.</p>';
}

// Close the last table division.

echo '</table>';
echo '</div>';
echo '<hr>';

// Close the connection.

$conn->close();
?>

        <br>
        <div id="Copyright" class="center">
                <h5>&copy; 2020, Amazon Web Services, Inc. or its Affiliates. All rights
                        reserved.</h5>
        </div>

</body>
</html>
