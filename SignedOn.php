<!DOCTYPE html>
<html>


<?php

require_once("ConnectAss1.php");
$conn = getDbConnection();


?>

<link rel="stylesheet" type="text/css" href="Styles.css">

<title>Login</title>

<style>
    table, th, tr, td { border: solid 2px black;}
</style>

<head >

</head>

<header>

    <?php

    //***************************************************************POST USERNAME AND PASS
    $UserName =     $_POST["UserName"];
    $Password = $_POST["Password"];

    //***************************************************************Perform strip
    $UserName =     stripslashes( $UserName);
    $Password = stripslashes($Password);
    $UserName =     mysqli_real_escape_string($conn, $UserName);
    $Password = mysqli_real_escape_string($conn,$Password);

    //***************************************************************Hash the password

    $hashedPassword =  hash("sha512",$Password);

    //***************************************************************Check Database to See if USER/PASS match

    //get username and password to see if they are a combo match in the database



    $sqlStatement = "SELECT * FROM Web_Users WHERE UserName='$UserName' and Password='$hashedPassword'";
    $result = mysqli_query($conn,$sqlStatement);
    $count = mysqli_num_rows($result);
    if (!$result) {

        die('Could not retrieve record from the Employees Database: ' . mysqli_error($conn));
    }

?>
    <table border="1">
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

    $Display = "SELECT emp_no,birth_date,first_name,last_name,gender,hire_date FROM employees ";

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




    <img id = "headerP" src="employee-icon.jpg">

</header>

<body >

<img id = "BackG" src="Bg.jpg">

</body >

<?php
function checkIfLoggedIn(){
    session_start();
    if(empty($_SESSION['UserName']) || (empty($_SESSION['Password']))){
        header("location:SignedOn.php");
    }
}
?>







</html>














































































<!DOCTYPE html>
<html>

<?php
//In order to keep this as a protected Page

require 'Login.php';
checkIfLoggedIn();

require_once("ConnectAss1.php");
$conn = getDbConnection();


?>

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

<table border="1">
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

    $Display = "SELECT emp_no,birth_date,first_name,last_name,gender,hire_date FROM employees ORDER BY ASC LIMIT 25";

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

=

    </tbody>
</table>
=

</body >

=
</html>





































































