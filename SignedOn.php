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

<title>Signed On</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >

</head>

<header>


    <img id = "headerP" src="employee-icon.jpg">

</header>

<body >

<img id = "BackG" src="Bg.jpg">

<table id = "ResultTable1 " border="1">
    <thead>
    <th>Emp.Number</th>
    <th>BirthDate</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Hire Date</th>
    <th><img id = "edit" src="file_edit.png"></th>
    </thead>
    <?php

    $Display = "SELECT emp_no,birth_date,first_name,last_name,gender,hire_date FROM employees ORDER BY emp_no DESC  LIMIT 25";

    $result2 = mysqli_query($conn, $Display);

    if (!$result2) {
        die("Could not retrieve records from database: " . mysqli_error($conn));
    }

    while($row = mysqli_fetch_assoc($result2)):
        ?>
        <tr>
            <td><?php echo $row['emp_no'] ?></td>
            <td><?php echo $row['birth_date'] ?></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><?php echo $row['hire_date'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><form action='EditEmp.php' method='POST'><input type='hidden' name='tempId' value='".$row["pId"]."'/><input type='submit' name='submit-btn' value='View/Update Details' /></td>


        </tr>

    <?php
    endwhile;


    mysqli_close($conn);
    ?>



    </tbody>
</table>


</body >



</html>






















































