




<?php

require_once("ConnectAss1.php");
$conn = getDbConnection();


//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();



?>

<!DOCTYPE html>
<html>




<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Employee Search</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >





</head>

<header>






    <img id = "headerP" src="employee-icon.jpg">

</header>

<body>
<?php


if(isset($_POST['BirthDate']) && isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Gender']) && isset($_POST['HireDate'])) {


    $emp_no = $_POST['tempId'];

    $FN = $_POST['FirstName'];
    $LN = $_POST['LastName'];
    $HD = $_POST['HireDate'];
    $BD = $_POST['BirthDate'];
    $G = $_POST['Gender'];


    $sql = "UPDATE employees SET birth_date = '";
    $sql .= $_POST['BirthDate'];
    $sql .= "', first_Name = '";
    $sql .= $_POST['FirstName'];
    $sql .= "', last_Name = '";
    $sql .= $_POST['LastName'];
    $sql .= "', gender = '";
    $sql .= $_POST['Gender'];
    $sql .= "' WHERE emp_no = ";
    $sql .= $emp_no;
    $sql .= ";";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Record Deleted";
    } else {
        echo "Unable to Update:" . mysqli_connect_error();

    }
}
mysqli_close($conn);
?>

</body>
<footer>

</footer>
</html>
