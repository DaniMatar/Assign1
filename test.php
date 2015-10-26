
<?php

require_once("ConnectAss1.php");
$conn = getDbConnection();

$Search = $_POST['Search'];
?>




<html>
<head>
    <title>PHP Pagination</title>
    <link rel="stylesheet" type="text/css" href="Styles.css" />
<head>
<body>
<div id="pagination">

    <h3 class="title">Database 	Records</h3>

    <div id="records">

        <?php

        // Ignore PHP Warnings
        error_reporting(E_ALL ^ E_NOTICE);

        // Database Connect

        // User Input
        if(isset($_GET['page'])) {
            $page = (int)$_GET['page'];
        }else {
            $page = 1;
        }

        if(isset($_GET['per-page']) && $_GET['per-page'] <= 50) {
            $per_page = (int)$_GET['per-page'];
        }else {
            $per_page = 25;
        }

        // Positining
        if($page > 1) {
            $start = ($page * $per_page - $per_page);
        }else {
            $start = 0;
        }

        // Query
        $data = mysqli_query($conn, "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name or last_name LIKE '%$Search%' ORDER BY emp_no DESC LIMIT $start, $per_page");
        while($row = mysqli_fetch_assoc($data)) {
            echo '<p class="record">'.$row['emp_no'].$row['first_name'].$row['last_name'].$row['gender'].$row['hire_date'].$row['birth_date'].'</p>';
        }

        // Count Data
        $count = mysqli_query($conn, "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name or last_name LIKE '%$Search%' ORDER BY emp_no DESC");
        $total = mysqli_num_rows($count);

        $pages = ceil($total / $per_page);

        for($x = 1; $x <= $pages; $x++) {
            if($page == $x) {
                //echo '<a class="page active">'.$x.'</a>';
                // Query
                $data = mysqli_query($conn, "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name or last_name LIKE '%$Search%' ORDER BY emp_no DESC LIMIT $start, $per_page");
                while($row = mysqli_fetch_assoc($data)) {
                    if ($row < 23) {
                        echo '<p class="record">' . $row['emp_no'] . $row['first_name'] . $row['last_name'] . $row['gender'] . $row['hire_date'] . $row['birth_date'] . '</p>';
                   }
                    else{
                        break;
                    }
                }
                }

            else {
               // echo '<a class="page" href="?page='.$x.'&per-page='.$per_page.'">'.$x.'</a>';
                if($x == 2) {
                    echo $x.'This is iteration 2';
                   // $start = ($page * $per_page - $per_page);

                    // Query
                    $data = mysqli_query($conn, "SELECT emp_no,first_name,last_name,gender,hire_date,birth_date FROM employees WHERE first_name or last_name LIKE '%$Search%' ORDER BY emp_no DESC LIMIT $start, $per_page");
                    while($row = mysqli_fetch_assoc($data))  {
                        echo '<p class="record">'.$row['emp_no'].$row['first_name'].$row['last_name'].$row['gender'].$row['hire_date'].$row['birth_date'].'</p>';
                    }
                }else {
                    if($x > 2) {
                        echo $x . 'This is iteration 3 plus';
                    }

                }
            }
        }


        ?>

    </div>

</div>


</body>
</html>
