<?php
    session_start();
    $maticni = $_SESSION["jmbg"];
    $servername = "localhost";
    $username = "id18650421_dentalclinicc";
    $password = "Predrag21.07.2000.";
    $dbname = "id18650421_dentalclinic";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    // sql to delete a record
    $sql = "DELETE FROM korisnici WHERE jmbg='$maticni'";
    
    if ($conn->query($sql) === TRUE) {
        header('location:prikazKorisnika.php');        
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    $conn->close();
?>