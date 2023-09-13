<?php

//localhost, username, password, DB name
 $db = mysqli_connect("localhost", "root", "", "library_app");
 
 if( $db ) {
    //echo "database connected succussfully";
 }
 else{
   die( "MYSQLi Error. " . mysqli_error($db) );
 }
