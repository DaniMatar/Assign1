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

    <?php

    $searchquery = $_POST['searchquery'];
    ?>


    <form action="Pagination.php" method="POST">
        <input id="Search" type="text" placeholder="Search" name = " searchquery" value="<?php echo $searchquery; ?>">
        <input id="submit" type="Submit" value="Search">
    </form>




</head>

<header>






    <img id = "headerP" src="employee-icon.jpg">

</header>

<body>



</body>
<footer>

</footer>
</html>














