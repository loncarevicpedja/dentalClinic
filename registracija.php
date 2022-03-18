<?php
    session_start();
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
        function redirect($location)
        {
            header('location: {$location}');
            exit();
        }                
        function validate_user_registration()
        {
            $errors = [];
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $ime = $_POST['ime'];
                $prezime = $_POST['prezime'];
                $pol = $_POST['pol'];
                $mesto_rodjenja = $_POST['mesto-rodjenja'];
                $drzava_rodjenja = $_POST['drzava-rodjenja'];
                $datum_rodjenja = $_POST['datum-rodjenja'];
                $maticni = $_POST['jmbg'];
                $telefon = $_POST['kontakt-telefon'];
                $email = $_POST['email'];
                $lozinka = $_POST['psw'];
                $potvrdjena_lozinka = $_POST['psw-repeat'];                
                $korisnicko_ime = strval(create_username($ime, $prezime));
                if (strlen($ime) < 3) {
                    $errors[] = "Vase ime ne sme biti krace od 3 karaktera";
                }
                if (strlen($prezime) < 3) {
                    $errors[] = "Vase prezime ne sme biti krace od 3 karaktera";
                }
                if (email_exists($email)) {
                    $errors[] = "Uneti mejl vec postoji";
                }
                if (strlen($lozinka) < 8) {
                    $errors[] = "Vasa lozinka ne sme biti kraca od 8 karaktera";
                }
                if ($lozinka != $potvrdjena_lozinka) {
                    $errors[] = "Neispravno unesene lozinke";
                }
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo '<div class="alert">' . $error . '</div>';
                    }
                } else {
                    $to = $email;
                    $subject = "HTML email";
                    
                    $message = "<a href='http://localhost/projekat/verify.php'>Verifikacija naloga</a>";
                    
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    
                    // More headers
                    $headers .= 'From: <cdental909@gmail.com>' . "\r\n";
                    $headers .= 'Cc: '.$to.'' . "\r\n";
                    
                    mail($to,$subject,$message,$headers);
                    echo "<script>alert('Poslali smo Vam link za verifikaciju na mail: '+'$email')</script>";
                    $_SESSION['korisnicko_ime'] = $korisnicko_ime;
                    $_SESSION['ime'] = $ime;                
                    $_SESSION['prezime'] = $prezime;                
                    $_SESSION['pol'] = $pol;                
                    $_SESSION['mesto_rodjenja'] = $mesto_rodjenja;              
                    $_SESSION['drzava_rodjenja'] = $drzava_rodjenja;              
                    $_SESSION['datum_rodjenja'] = $datum_rodjenja;              
                    $_SESSION['jmbg'] = $maticni;              
                    $_SESSION['telefon'] = $telefon;              
                    $_SESSION['mail'] = $to;                
                    $_SESSION['lozinka'] = $lozinka;                                           
                }
            }
        }
        function email_exists($email)
        {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $query = "SELECT jmbg FROM korisnici WHERE email LIKE '$email'";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "proba";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        function username_exists($korisnickoIme)
        {
        $query = "SELECT jmbg FROM korisnici WHERE username LIKE '$korisnickoIme'";
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "proba";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        function create_username($name, $surname){
                $a = 1; 
                $korisnickoIme = "";
                $name=strtolower($name);
                $surname=strtolower($surname);
                $korisnickoIme .= $name[0]; 
                $korisnickoIme .= $surname; 
                if(username_exists($korisnickoIme) == true){
                    while(username_exists($korisnickoIme))                
                        $korisnickoIme .= strval($a);
                        $a++;
                    }
                    return $korisnickoIme;               
                }
        
        validate_user_registration();
        ?>
        <div class="content">
            <form method="POST">
                <div class="cont">
                    <h1>Registracija</h1>
                    <hr>

                    <label for="ime"><b>Ime</b></label>
                    <input type="text" placeholder="Unesite ime" name="ime" id="ime" required>
                    
                    <label for="prezime"><b>Prezime</b></label>
                    <input type="text" placeholder="Unesite prezime" name="prezime" id="prezime" required>
                    
                    <label for="pol"><b>Pol</b></label>
                    <div class="poll">
                        <input type="radio" placeholder="Muški" name="pol" id="pol" value="M" required><label>Muški</label>
                        <input type="radio" placeholder="Ženski" name="pol" id="pol" value="Z" required><label>Ženski</label><br>
                    </div>
                    <label for="mesto-rodjenja"><b>Mesto rodjenja</b></label>
                    <input type="text" placeholder="Unesite mesto rodjenja" name="mesto-rodjenja" id="mesto-rodjenja" required>
                                        
                    <label for="drzava-rodjenja"><b>Država rodjenja</b></label>
                    <input type="text" placeholder="Unesite drzavu rodjenja" name="drzava-rodjenja" id="drzava-rodjenja" required>
                                   
                    <label for="datum-rodjenja"><b>Datum rodjenja</b></label>
                    <input type="date" placeholder="Unesite datum rodjenja" name="datum-rodjenja" id="datum-rodjenja" required>

                    <label for="jmbg"><b>JMBG</b></label>
                    <input type="text" placeholder="Unesite JMBG" name="jmbg" id="jmbg" required>
                    
                    <label for="telefon"><b>Kontakt telefon</b></label>
                    <input type="text" placeholder="Unesite kontakt telefon" name="kontakt-telefon" id="kontakt-telefon" required>
                    
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Unesite Email" name="email" id="email" required>

                    <label for="psw"><b>Lozinka</b></label>
                    <input type="password" placeholder="Unesite lozinku" name="psw" id="psw" required>

                    <label for="psw-repeat"><b>Potvrda lozinke</b></label>
                    <input type="password" placeholder="Potvrdite lozinku" name="psw-repeat" id="psw-repeat" required>

                    <hr>
                    <button type="submit" class="registerbtn">Register</button>
                </div>
                
                <div class="container signin">
                    <p>Imate nalog?<br> <a href="prijava.php">Prijavite se</a>.</p>
                </div>
            </form>
        </div>
        <div class="footer">
                <div class="footer_info">
                    <div class="footer_logo_kontakt">
                        <div class="logo2">
                            <div class="prvi">                            
                                <p class="logo2_font">dental</p>
                            </div>
                            <div class="drugi">
                                <i class="fas fa-tooth"></i>
                            </div>
                            <div class="treci">
                                <p c lass="logo2_font">clinic</p>
                            </div>
                        </div>
                        <div class="informacije">
                            <div class="adresa">
                            <p>Sokobanjska 3, 11000 Beograd, Srbija</p>
                            </div>
                            <div class="telefon">
                            <i class="fas fa-phone"></i>
                            <p>+381 11 3671 133</p>
                            </div>
                            <div class="telefon1">
                            <i class="fas fa-phone"></i>
                            <p>+381 11 3671 133</p>
                            </div>
                            <div class="mail">
                            <i class="far fa-envelope"></i>
                            <p>loncarevicpedja2000@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="zakazite_pregled">
                        <h2>ZAKAŽITE BESPLATAN PREGLED</h2>
                        <hr>
                        <p>Prvi pregled u stomatološkoj ordinaciji Dental Clinic je besplatan. Pregledom ćete saznati sve o Vašem stomatološkom problemu i kako ga rešiti. U toku pregleda se dobija informacija kojim sve metodama i na koji nacin se može rešiti problem u Vašim ustima. I na kraju se može dobiti obaveštenje o ceni stomatoloških usluga.</p>
                        <button class="button-18" role="button">ZAKAŽITE PREGLED</button>
                    </div>
                    <div class="lokacija">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.9075546262457!2d20.460219414923678!3d44.782689986679095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7041aad2322b%3A0x2f62ab55af9c1698!2sSokobanjska%203%2C%20Beograd!5e0!3m2!1sbs!2srs!4v1641391481344!5m2!1sbs!2srs" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="footer_copyright">
                        <p>Copyright ©2022 Dental Clinic. All Right</p>
                </div>
        </div>
    </div>
</body>
</html>