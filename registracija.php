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
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">    
    <title>Dental clinic</title>
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
                        <li><a href="./nalsovna.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="./nalsovna.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="./nalsovna.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="./nalsovna.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="./nalsovna.php/#footer"><p>KONTAKT</p></a></li>    
                        
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
                $lozinkaa = password_hash($lozinka, PASSWORD_DEFAULT);
                $izabraniLekar = $_POST['izabraniLekar'];               
                $korisnicko_ime = strval(create_username($ime, $prezime));
                if (strlen($ime) < 3) {
                    $errors[] = "Vase ime ne sme biti krace od 3 karaktera";
                }
                if (!preg_match("/^[a-zA-Z]*$/",$ime)) {
                    $errors[] = "Ime ne sme sadrzati bilo sta osim slova.";
                }
                if (strlen($prezime) < 3) {
                    $errors[] = "Vase prezime ne sme biti krace od 3 karaktera";
                }
                if (!preg_match("/^[a-zA-Z]*$/",$prezime)) {
                    $errors[] = "Prezime ne sme sadrzati bilo sta osim slova.";
                }
                if (!preg_match("/^[a-zA-Z ]*$/",$mesto_rodjenja)) {
                    $errors[] = "Mesto rodjenja ne sme sadrzati bilo sta osim slova.";
                }
                if (strlen($mesto_rodjenja) < 2) {
                    $errors[] = "Mesto rodjenja ne sme biti krace od 8 karaktera";
                }
                if (strlen($drzava_rodjenja) < 2) {
                    $errors[] = "Drzava rodjenja ne sme biti kraca od 8 karaktera";
                }
                if (!preg_match("/^[a-zA-Z ]*$/",$drzava_rodjenja)) {
                    $errors[] = "Drzava rodjenja ne sme sadrzati bilo sta osim slova.";
                }
                if (!preg_match("/^[0-9]*$/",$maticni)) {
                    $errors[] = "Maticni broj mora sadrzati samo brojeve.";
                }
                if (!preg_match("/^[0-9+ ]*$/",$telefon)) {
                    $errors[] = "Konakt telefon mora sadrzati samo brojeve.";
                }
                if (strlen($maticni) != 13) {
                    $errors[] = "Maticni broj mora sadrzati 13 cifara";
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
                    echo "<script>alert('".$error."')</script>";
                    // echo "$error";
                    return;
                    }
                } else {
                    $to = $email;
                    $slika="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png";
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

            $sql = "INSERT INTO zahtevi (verify, ime, prezime, pol, mesto_rodjenja, drzava_rodjenja, datum_rodjenja, jmbg, telefon, izabraniLekar, email, username, lozinka, slika)
            VALUES ('no','$ime', '$prezime', '$pol' , '$mesto_rodjenja', '$drzava_rodjenja', '$datum_rodjenja', '$maticni', '$telefon', '$izabraniLekar', '$email', '$korisnicko_ime','$lozinkaa', '$slika')";

            if ($conn->query($sql) === TRUE) {
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;echo "Greska!";
            }

            $conn->close();  
        }

                    $subject = "DentalClinic";
                        
                    $message = "<div class='card' style=' border: 1px solid grey;width: 340px; height: 200px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
                        <div class='card_header' style='width: 100%; height: 50px; background-color: rgb(7, 137, 212); padding-left: 5px;padding-top: 2px;'>
                        <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;'><b>dentalClinic</b></div>
    
                        </div>
                        <div class='card_content' style='padding: 10px;'>
                            <h4>Dobrodosao/la u DentalClinic!<br>Zahtev za registraciju mozes izvrsiti klikom na dugme ispod!</h4>
                            <form action='https://dentalclinicbg.000webhostapp.com/verify.php' method='GET'>
                            <input type='text' name='mejlPost' value='".$to."' style='display:none'>
                            <input type='submit' style='background-color: rgb(7, 137, 212); height: 30px; border: none; color: antiquewhite; margin-left: 30%;' value='Registruj se!'>
                            </form>
                        </div>
                    </div>";
                    
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    
                    // More headers
                    $headers .= 'From: <cdental909@gmail.com>' . "\r\n";
                    $headers .= 'Cc: '.$to.'' . "\r\n";
                    
                    mail($to,$subject,$message,$headers);
                    echo "<script>alert('Poslali smo Vam link za verifikaciju na mail: '+'$email')</script>";
                    echo '<meta http-equiv="refresh" content="0; URL=nalsovna.php">';
                
            }
        }
        function email_exists($email)
        {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $query = "SELECT jmbg FROM korisnici WHERE email LIKE '$email'";
        $servername = "localhost";
    $username = "id18650421_dentalclinicc";
    $password = "Predrag21.07.2000.";
    $dbname = "id18650421_dentalclinic";

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
    $username = "id18650421_dentalclinicc";
    $password = "Predrag21.07.2000.";
    $dbname = "id18650421_dentalclinic";

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
            <form id="formica" method="POST">
                <div class="cont">
                    <h1>Registracija</h1>
                    <hr>

                    <label for="ime"><b>Ime</b></label>
                    <input type="text" placeholder="Unesite ime" name="ime" id="ime" required>
                    
                    <label for="prezime"><b>Prezime</b></label>
                    <input type="text" placeholder="Unesite prezime" name="prezime" id="prezime" required>
                    
                    <label for="pol"><b>Pol</b></label>
                    <div class="poll">
                        <input type="radio" placeholder="Mu??ki" name="pol" id="pol" value="M" required><label>Mu??ki</label>
                        <input type="radio" placeholder="??enski" name="pol" id="pol" value="Z" required><label>??enski</label><br>
                    </div>
                    <label for="mesto-rodjenja"><b>Mesto rodjenja</b></label>
                    <input type="text" placeholder="Unesite mesto rodjenja" name="mesto-rodjenja" id="mesto-rodjenja" required>
                                        
                    <label for="drzava-rodjenja"><b>Dr??ava rodjenja</b></label>
                    <input type="text" placeholder="Unesite drzavu rodjenja" name="drzava-rodjenja" id="drzava-rodjenja" required>
                                   
                    <label for="datum-rodjenja"><b>Datum rodjenja</b></label>
                    <input type="date" placeholder="Unesite datum rodjenja" name="datum-rodjenja" id="datum-rodjenja" required>

                    <label for="jmbg"><b>JMBG</b></label>
                    <input type="text" placeholder="Unesite JMBG" name="jmbg" id="jmbg" required>
                    
                    <label for="telefon"><b>Kontakt telefon</b></label>
                    <input type="text" placeholder="Unesite kontakt telefon" name="kontakt-telefon" id="kontakt-telefon" required>
                    <?php 
                    $servername = "localhost";
                    $username = "id18650421_dentalclinicc";
                    $password = "Predrag21.07.2000.";
                    $dbname = "id18650421_dentalclinic";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT jmbg, ime, prezime FROM korisnici WHERE tip='lekar'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        
                    echo "<label for='izabraniLekar'><b>Izabrani lekar</b></label>                        
                        <select id='izabraniLekar' name='izabraniLekar'>";
                        while($row = $result->fetch_assoc()) {
                                    echo"<option value='".$row['ime']." ".$row['prezime']."'>Dr ".$row['ime']." ".$row['prezime']."</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Unesite Email" name="email" id="email" required>

                    <label for="psw"><b>Lozinka</b></label>
                    <input id="psw" type="password" placeholder="Unesite lozinku" name="psw" required>

                    <label for="psw-repeat"><b>Potvrda lozinke</b></label>
                    <input id="psw-repeat" type="password" placeholder="Potvrdite lozinku" name="psw-repeat" required>
                    <input type="checkbox" onclick="showPasswords()">Prikazi lozinke

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
                        <h2>ZAKA??ITE BESPLATAN PREGLED</h2>
                        <hr>
                        <p>Prvi pregled u stomatolo??koj ordinaciji Dental Clinic je besplatan. Pregledom ??ete saznati sve o Va??em stomatolo??kom problemu i kako ga re??iti. U toku pregleda se dobija informacija kojim sve metodama i na koji nacin se mo??e re??iti problem u Va??im ustima. I na kraju se mo??e dobiti obave??tenje o ceni stomatolo??kih usluga.</p>
                        <button class="button-18" role="button">ZAKA??ITE PREGLED</button>
                    </div>
                    <div class="lokacija">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.9075546262457!2d20.460219414923678!3d44.782689986679095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7041aad2322b%3A0x2f62ab55af9c1698!2sSokobanjska%203%2C%20Beograd!5e0!3m2!1sbs!2srs!4v1641391481344!5m2!1sbs!2srs" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="footer_copyright">
                        <p>Copyright ??2022 Dental Clinic. All Right</p>
                </div>
        </div>
    </div>
    <script>
        function showPasswords(){
            showPassword("psw")
            showPassword("psw-repeat")
        }
        function showPassword(id) {
            var x = document.getElementById(id);
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</body>
</html>