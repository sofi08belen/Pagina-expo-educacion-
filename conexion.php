<?php
$servername = "localhost";
$basededatos="expo_edu";
$usuario="root";
$contrasenha="";
// Create connection
$conn = mysqli_connect($servername,$basededatos,$usuario,$contrasenha);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conn);
?>