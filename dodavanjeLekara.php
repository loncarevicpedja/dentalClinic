<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">    
    <title>Dental clinic</title>
    <style>
        <?php include'dodavanjeLekara.css';?>
    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="header">
            <div class="navbar">
                <div class="logo">
                    <p class="logo_font">dental</p>
                    <i class="fas fa-tooth"></i>
                    <p class="logo_font">clinic</p>
                </div>
                <div class="meni">
                    <ul>
                    <li><a href="nalsovnaAdmin.php"><p>NASLOVNA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaAdmin.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaAdmin.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaAdmin.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaAdmin.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaAdmin.php/#footer"><p>KONTAKT</p></a></li>
                        
                        <?php if(!isset($_SESSION['zaglavljeEmail'])) : ?>
                            <li id="prijava"><a href="prijava.php"><p>PRIJAVI SE</p></a></li>
                        <?php else : ?>
                        <div class="meni_i_opcije">
                        <div class="korisnicko_i_dugme">
                            <li id="prijavljen"><a><p><?php echo $_SESSION['zaglavljeEmail'];?></p></a></li>
                            <i onclick="openMenu()" class="fa-solid fa-plus"></i>
                            
                        </div>
                            <div id="reg_meni" class="reg_meni">
                                <ul>
                                    <li class="pregledKorisnika"><a href="zahteviAdmin.php">PREGLED ZAHTEVA</a></li>
                                    <li><a href="prikazKorisnika.php">PRIKAZ KOSINIKA</a></li>
                                    <li><a href="dodavanjeLekara.php">KREIRAJ NALOG ZA LEKARA</a></li>
                                    <li><a href="dodavanjeVestiAdmin.php">DODAJ VEST</a></li>
                                    <li id="odjava"><a href="./logout.php">ODJAVITE SE<i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="contentCenter">
                <h1>Dodaj lekara</h1>
                <div class="forma" >
                    <form method="POST">
                        <div class="raspored">
                            <label for="ime"><b>Ime</b></label>
                            <input type="text" placeholder="Unesite ime" name="ime" id="ime" required>
                        </div>
                    
                        <div class="raspored">
                            <label for="prezime"><b>Prezime</b></label>
                            <input type="text" placeholder="Unesite prezime" name="prezime" id="prezime" required>
                        </div>
                    <div class="raspored">
                        <label for="pol"><b>Pol</b></label>
                        <div class="poll">
                            <input type="radio" placeholder="Muški" name="pol" id="pol" value="M" required><label>Muški</label>
                            <input type="radio" placeholder="Ženski" name="pol" id="pol" value="Z" required><label>Ženski</label><br>
                        </div>
                    </div>
                    <div class="raspored">
                        <label for="mesto-rodjenja"><b>Mesto rodjenja</b></label>
                        <input type="text" placeholder="Unesite mesto rodjenja" name="mesto-rodjenja" id="mesto-rodjenja" required>
                    </div>
                    <div class="raspored">
                        <label for="drzava-rodjenja"><b>Država rodjenja</b></label>
                        <input type="text" placeholder="Unesite drzavu rodjenja" name="drzava-rodjenja" id="drzava-rodjenja" required>
                    </div>
                    <div class="raspored">
                        <label for="datum-rodjenja"><b>Datum rodjenja</b></label>
                        <input type="date" placeholder="Unesite datum rodjenja" name="datum-rodjenja" id="datum-rodjenja" required>
                    </div>
                    
                    <div class="raspored">
                        <label for="jmbg"><b>JMBG</b></label>
                        <input type="text" placeholder="Unesite JMBG" name="jmbg" id="jmbg" required>
                    </div>
                    
                    <div class="raspored">
                        <label for="telefon"><b>Kontakt telefon</b></label>
                        <input type="text" placeholder="Unesite kontakt telefon" name="kontakt-telefon" id="kontakt-telefon" required>
                    </div>
                    
                    <div class="raspored">
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="Unesite Email" name="email" id="email" required>
                    </div>
                    
                    <div class="raspored">
                        <label for="specijalizacija"><b>Specijalizacija</b></label>
                        <input type="text" placeholder="Specijalizacija" name="specijalizacija" id="specijalizacija" required>
                    </div>
                    
                    <div class="raspored">
                        <label for="opis"><b>Opis</b></label>
                        <textarea type="text" placeholder="Unesite opis lekara..." name="opis" id="opis" required></textarea>
                    </div>
                    
                    <div class="raspored">
                        <label for="slika"><b>Slika</b></label>
                        <input type="file" placeholder="Unesite link slike..." accept="image/png, image/jpeg" name="slika" id="slika" required>
                    </div>



                    <button type="submit" class="addBtn" name="dodavanjeLekara">Dodaj lekara</button>
                </form>
                </div>
            </div>
        </div>
    </div>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['dodavanjeLekara']))
        {
            dodajLekara();
        }
        function create_username($name, $surname){
            $korisnickoIme = "";
            $name=strtolower($name);
            $surname=strtolower($surname);
            $korisnickoIme .= $name[0]; 
            $korisnickoIme .= $surname; 
            return $korisnickoIme;   
        }
        function create_password($name){
            $name = strtolower($name);
            return $name .= "12345";
        }
        function dodajLekara(){
            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $pol = $_POST['pol'];
            $mesto_rodjenja = $_POST['mesto-rodjenja'];
            $drzava_rodjenja = $_POST['drzava-rodjenja'];
            $datum_rodjenja = $_POST['datum-rodjenja'];
            $maticni = $_POST['jmbg'];
            $telefon = $_POST['kontakt-telefon'];
            $email = $_POST['email'];
            $slika = $_POST["slika"];
            $opis = $_POST["opis"];
            $specijalizacija = $_POST["specijalizacija"];
            $korisnickoIme = create_username($ime, $prezime);
            $lozinka = create_password($ime);
            $lozinkaHash = password_hash($lozinka, PASSWORD_DEFAULT);
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

            $sql = "INSERT INTO korisnici (ime, prezime, pol, mesto_rodjenja, drzava_rodjenja, datum_rodjenja, jmbg, telefon, email, username, lozinka, slika, tip)
            VALUES ('$ime', '$prezime', '$pol', '$mesto_rodjenja', '$drzava_rodjenja', '$datum_rodjenja', '$maticni', '$telefon', '$email', '$korisnickoIme', '$lozinkaHash', '$slika', 'lekar')";

            if ($conn->query($sql) === TRUE) {
                $to = $email;
                $subject = "DentalClinic nalog";                
                $message = "<div class='card' style='width: 350px; height: 400px; border: 1px solid grey; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
                    <div class='card_header' style='width: 100%; height: 50px; background-color: rgb(7, 137, 212); padding-left: 5px;padding-top: 2px;'>
                        <div class='logo' style='margin-top: 5px; width: 87px; background-color: white; padding: 7px; border-radius: 15px;'><b>dentalClinic</b></div>
                    </div>
                    <div class='card_content' style='padding: 10px;'>
                        <h4>Dobrodosao/la u DentalClinic!<br>Kreiran Vam je nalog od strane administraotra. Mozete se prijaviti sa dole navedenim korisnickoim imenom i lozinkom.<br>Lozinka je genericka i mozete je promeniti.<br></h4>
                        <h4>Korisnicko ime:</h4>
                        <h4 style='text-align: center;'>".$korisnickoIme."</h4>
                        <h4>Lozinka:</h4>
                        <h4 style='text-align: center;'>".$lozinka."</h4>
                        <button style='background-color: rgb(7, 137, 212); height: 30px; border: none; color: antiquewhite; margin-left: 40%;'><a href='http://localhost/projekat/prijava.php' style='text-decoration: none; color: aliceblue;'>Prijavi se!</a></button>
                    </div>
                </div>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <cdental909@gmail.com>' . "\r\n";
                $headers .= 'Cc: '.$to.'' . "\r\n";
                mail($to,$subject,$message,$headers);

                echo "<script>alert('Uspesno ste dodali lekara!')</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    <script>
        function openMenu() {
            document.getElementById("reg_meni").classList.toggle("show");
            document.getElementById("imagee").classList.toggle("zatamni");
        }
    </script>
</body>
</html>