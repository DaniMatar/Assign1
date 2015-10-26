<?php
//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();


require_once("ConnectAss1.php");
$conn = getDbConnection();

$date = date('Y-m-d');



?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >
    <script src ="FormVal.js" type = "text/javascript"></script>


</head>

<header>






    <img id = "headerP" src="employee-icon.jpg">


</header>

<body >

<form action="AddEmp.php" method="POST" name="MyForm" id = "MyForm"  onsubmit="return checkForm()">

    <input id="FirstName" type="text" placeholder="FirstName" name = "FirstName"><br>

    <input id="LastName" type="text" placeholder="LastName" name = "LastName"><br>

    <input id="BirthDate"  type="date" value="YYYY-MM-DD"  name = "BirthDate"><br>

    <input id="HireDate"   type="date" value="YYYY-MM-DD"  name = "HireDate"><br>

    <input id="Gender" type="text" placeholder="Gender" name = "Gender"><br>

    <input id="submit" type="submit" value="Add">
</form>



<?php
$dat = $_POST['HireDate'];

echo $dat;

if (!empty($_POST['FirstName']) && !empty($_POST['LastName'])&& !empty($_POST['BirthDate'])&& !empty($_POST['HireDate'])&& !empty($_POST['Gender'])) {





    $sql = "INSERT (first_name,last_name,gender,hire_date,birth_date) INTO employees VALUES ('";
    $sql .= $_POST['FirstName'];
    $sql .= "','";
    $sql .= $_POST['LastName'];
    $sql .= "','";
    $sql .= $_POST['Gender'];
    $sql .= "','";
    $sql .= $_POST['HireDate'];
    $sql .= "','";
    $sql .= $_POST['BirthDate'];
    $sql .= "');";


    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Unable to insert Record: " . mysqli_error($conn));

    }

    echo("Employee Record is Stored");
}
mysqli_close($conn);
?>






</body >





</html>

