<?php
$hostname="localhost"; //local server name default localhost
$username="root";  //mysql username default is root.
$password="";       //blank if no password is set for mysql.
$database="test";  //database name which you created
$conn = mysqli_connect($hostname,$username,$password,$database);
if(!$conn)
{
    die('Connection Failed'.mysqli_connect_error());
}
//echo "Connected successfully";
?>