<?php
    mysql_connect("localhost", "root", "usbw") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("csv") or die(mysql_error());
    /* csv is the name of database I've created */
?>
