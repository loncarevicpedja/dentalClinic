<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Document</title>
    <style>
        <?php include'registracija.css'?>
    </style>
</head>
<body>
    <div class="container">
        <div class="heead">
            <div class="navbar">
                    <div class="logo">
                        <p class="logo_font">dental</p>
                        <i class="fas fa-tooth"></i>
                        <p class="logo_font">clinic</p>
                    </div>
                    <div class="meni">
                        <ul>
                        <li><a href="nalsovna.php"><p>NASLOVNA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/nalsovna.php/#footer"><p>KONTAKT</p></a></li>
                        
                            <li id="prijava"><a href="prijava.php"><p>PRIJAVI SE</p></a></li>
                        </ul>
                    </div>
            </div>
        </div>
        <?php 
        $slika="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png";
        $ime = $_SESSION["ime"];
        $prezime = $_SESSION["prezime"];
        $pol = $_SESSION["pol"];
        $mesto_rodjenja = $_SESSION["mesto_rodjenja"];
        $drzava_rodjenja = $_SESSION["drzava_rodjenja"];
        $datum_rodjenja = $_SESSION["datum_rodjenja"];
        $jmbg = $_SESSION["jmbg"];
        $telefon = $_SESSION["telefon"];
        $email = $_SESSION["mail"];
        $lozinka = $_SESSION["lozinka"];              
        $korisnickoIme = $_SESSION["korisnicko_ime"]; 
        function create_user($ime, $prezime, $pol, $mesto_rodjenja, $drzava_rodjenja, $datum_rodjenja, $jmbg, $telefon, $email, $lozinka, $korisnickoIme, $slika){
            $lozinka = password_hash($lozinka, PASSWORD_DEFAULT);

               
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proba";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "INSERT INTO zahtevi (ime, prezime, pol, mesto_rodjenja, drzava_rodjenja, datum_rodjenja, jmbg, telefon, email, username, lozinka, slika)
            VALUES ('$ime', '$prezime', '$pol' , '$mesto_rodjenja', '$drzava_rodjenja', '$datum_rodjenja', '$jmbg', '$telefon', '$email', '$korisnickoIme','$lozinka', '$slika')";

            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;echo "Greska!";
            }

            $conn->close();  
        }



        create_user($ime, $prezime, $pol, $mesto_rodjenja, $drzava_rodjenja, $datum_rodjenja, $jmbg, $telefon, $email, $lozinka, $korisnickoIme, $slika);
        session_destroy();
        ?>
        <div class="content_verify">
            <h1 class="obavestenjeVerifikacija">Uspesno ste poslali zahtev za registraciju!<br>U najkracem vremenskom roku cemo uzeti Vas zahtev u razmatranje.<br>Hvala!</h1>
            <button id="dugme_nazad" class="button-18" role="button"><a href="nalsovna.php">NAZAD NA NASLOVNU STRANICU<a></button>
        </div>
    </div>
</body>
</html>