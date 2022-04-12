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
     $to = $email;
                $subject = "DentalClinic nalog";                
                $message = "<div class='card' style='width: 350px; height: 400px; border: 1px solid grey; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
                    <div class='card_header' style='width: 100%; height: 50px; background-color: rgb(7, 137, 212); padding-left: 5px;padding-top: 2px;'>
                        <div class='logo' style='margin-top: 5px; width: 87px; background-color: white; padding: 7px; border-radius: 15px;'><b>dentalClinic</b></div>
                    </div>
                    <div class='card_content' style='padding: 10px;'>
                        <h4>Dobrodosao/la u DentalClinic!<br>Vas nalog je kreiran! Mozete se prijaviti sa dole navedenim korisnickoim imenom i lozinkom.<br></h4>
                        <h4>Korisnicko ime:</h4>
                        <h4 style='text-align: center;'>".$korisnickoIme."</h4>
                        <button style='background-color: rgb(7, 137, 212); height: 30px; border: none; color: antiquewhite; margin-left: 40%;'><a href='https://dentalclinicbg.000webhostapp.com/prijava.php' style='text-decoration: none; color: aliceblue;'>Prijavi se!</a></button>
                    </div>
                </div>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <cdental909@gmail.com>' . "\r\n";
                $headers .= 'Cc: '.$to.'' . "\r\n";
                mail($to,$subject,$message,$headers);
    include'brisiZahtev.php';    
    echo "<p>Pacijent je uspesno dodat!</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
