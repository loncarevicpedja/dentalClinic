<?php
    // session_start();
    $maticni = $_POST["jmbg"];
    echo "<script>alert('id: '+'.$maticni.')</script>";

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "proba";
    
    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // } 
    
    // // sql to delete a record
    // $sql = "DELETE FROM zahtevi WHERE jmbg='$maticni'";
    
    // if ($conn->query($sql) === TRUE) {
        // header('location:zahteviAdmin.php');        
    // } else {
    //     echo "Error deleting record: " . $conn->error;
    // }
    
    // $conn->close();
?>