<?php

require_once("ConnectAss1.php");
$conn = getDbConnection();


//this piece of code must be the first thing
// on the page to make this a protected page
require ('CheckIfLoggedIn.php');
checkIfLoggedIn();



$emp_no = $_POST['tempId'];

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
$sql22 = "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE emp_no LIKE '%$emp_no%' ";


$sql2 = mysqli_query($conn, $sql22) ;
?>



            <?php



            while ($row = mysqli_fetch_assoc($sql2)):
                ?>
                <script src ="FormVal.js" type = "text/javascript"></script>
                <form action="DispEditEmp.php" method="POST" name="MyForm" id = "MyForm"  onsubmit="return checkForm()">

                    <input id="FirstName" type="text"  value="<?php echo $row['first_name'] ?>" placeholder="FirstName" name = "FirstName"><br>

                    <input id="LastName" type="text" value="<?php echo $row['last_name'] ?>" placeholder="LastName" name = "LastName"><br>

                    <input id="BirthDate"  type="date" value="<?php echo $row['birth_date'] ?>"  name = "BirthDate"><br>

                    <input id="HireDate"  max ="<?php date("Y/m/d")  ?>"  type="date" value="<?php echo $row['hire_date'] ?>"  name = "HireDate"><br>

                    <input id="Gender" type="text" placeholder="Gender" value="<?php echo $row['gender'] ?>"  name = "Gender"><br>

                    <input id="submit" type="submit" value="Edit">
                </form>


                <form name=myform action = Deleted.php>
                    <input type=button value="Delete" onsubmit="return Confirm()">

                </form>









            <?php
            endwhile;





            mysqli_close($conn);

            ?>







</body>
<footer>

</footer>
</html>













