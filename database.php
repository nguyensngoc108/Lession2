<?php

function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "category_management";
 $dbport = 4306; // Port used by MySQL/MariaDB

 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db, $dbport, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>