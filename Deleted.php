




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


    <form action="Pagination.php" method="POST">
        <input id="Search" type="text" placeholder="Search" name = " searchquery" value="Search">
        <input id="submit" type="Submit" value="Submit">
    </form>




</head>

<header>






    <img id = "headerP" src="employee-icon.jpg">

</header>

<body>
<?php
$emp_no = $_POST['tempId'];

$sql = "DELETE * FROM employees WHERE emp_no LIKE '%$emp_no%' ";
echo "Record Deleted";
mysqli_close($conn);
?>

</body>
<footer>

</footer>
</html>














