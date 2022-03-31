<?php
session_start();
$slika=$_SESSION["slika"];
$ime = $_SESSION["ime"];
$prezime = $_SESSION["prezime"];
$pol = $_SESSION["pol"];
$mesto_rodjenja = $_SESSION["mesto_rodjenja"];
$drzava_rodjenja = $_SESSION["drzava_rodjenja"];
$datum_rodnjenja = $_SESSION["datum_rodjenja"];
$jmbg = $_SESSION["jmbg"];
$telefon = $_SESSION["telefon"];
$email = $_SESSION["email"];
$lozinka = $_SESSION["lozinka"];
$korisnickoIme = $_SESSION["korisnicko_ime"]; 
$izabarniLekar = $_SESSION["izabraniLekar"];

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

$sql = "INSERT INTO korisnici (ime, prezime, pol, mesto_rodjenja, drzava_rodjenja, datum_rodjenja, jmbg, telefon, izabraniLekar, email,username, lozinka, slika, tip)
VALUES ('$ime', '$prezime', '$pol', '$mesto_rodjenja', '$drzava_rodjenja', '$datum_rodnjenja', '$jmbg', '$telefon', '$izabarniLekar','$email', '$korisnickoIme', '$lozinka', '$slika', 'pacijent')";

if ($conn->query($sql) === TRUE) {
    include'brisiZahtev.php';    
    echo "<p>Pacijent je uspesno dodat!</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
