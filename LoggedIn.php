<?php
//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();


require_once("ConnectAss1.php");
$conn = getDbConnection();



?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >
<?php

$PHArray = array();





$query = ("SELECT CONCAT(first_name,'  ',last_name,'        ','Hire Date: ',hire_date) As Emply FROM employees ORDER BY hire_date DESC LIMIT 5");
$FQuery= mysqli_query($conn, $query);


    while ($row = mysqli_fetch_array($FQuery, MYSQL_BOTH)):
    {

        $PHArray[] = $row['Emply'];


    }
    endwhile;

    mysqli_close($conn);

    ?>

    <SCRIPT type="text/javascript">

        var JArray = [];

        JArray =  <?php echo json_encode($PHArray); ?>;


        function display()
        {
            a=Math.floor(Math.random()*JArray.length)
            document.getElementById('JArray').innerHTML=JArray[a]
            setTimeout("display()",1500)
        }
    </SCRIPT>








</head>

<header>
    <form id = "GOTOAll " action="AllEmp.php" method="POST">
        <input id="submit" type="submit" value="View All Employees">
    </form>

    <form id = "GOTOSearch " action="Pagination.php" method="POST">
        <input id="submit" type="submit" value="Search For Employees">
    </form>


    <form id = "GOTOAdd " action="AddEmp.php" method="POST">
        <input id="submit" type="submit" value="Add Employee">
    </form>

    <img id = "headerP" src="employee-icon.jpg">


</header>

<body >






    <img id = "hires" src="hires.jpg">


<div id="JArray">
    <SCRIPT type="text/javascript">display()</SCRIPT>



</div>

</body >





</html>

