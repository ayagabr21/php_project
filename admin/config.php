<?php 
    /*
        mysqli | mysqli oop | PDO  


        PDO => PHP data object 
          1-injections 
          2- OOP 
          3- more secure 
    */
    $dsn = "mysql:host=localhost;dbname=php61";
    $username = "root";
    $password = "";
    try{
        $con = new PDO($dsn , $username , $password);
        // echo "connect";
    }catch(PDOExecption $e){
        echo $e;
    }

?>