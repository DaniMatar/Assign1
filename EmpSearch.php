
<?php
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();


require_once("ConnectAss1.php");
$conn = getDbConnection();



$NSearch = $_POST['NSearch'] ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >

</head>

<header>


    <form action="EmpSearch.php" method="POST">
        <input id="Search" type="text" placeholder="Search" name = "Search" value="<?php echo $NSearch;?>">
        <input id="submit" type="submit" value="Search">
    </form>




    <img id = "headerP" src="employee-icon.jpg">

</header>

<body >



</body >





</html>
