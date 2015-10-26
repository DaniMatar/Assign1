<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 10/5/15
 * Time: 11:10 AM
 */


function getDbConnection()
{
    $conn = mysqli_connect("localhost", "root", "inet2005", "employees");
    if(!$conn)
    {
        die("Unable to connect to database: " . mysqli_connect_error());
    }

    return $conn;
}





