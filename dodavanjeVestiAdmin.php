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
        <?php include'zahteviAdmin.css';?>
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
                                                <li><a href="./nalsovnaAdmin.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="./nalsovnaAdmin.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="./nalsovnaAdmin.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="./nalsovnaAdmin.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="./nalsovnaAdmin.php/#footer"><p>KONTAKT</p></a></li>    
                        
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
                                    <li><a href="prikazLekara.php">PRIKAZ LEKARA</a></li>
                                    <li><a href="dodavanjeLekara.php">KREIRAJ NALOG ZA LEKARA</a></li>
                                    <li><a href="promenaRasporeda.php">PROMENA RASPOREDA</a></li>
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
                <h1>Dodaj vest</h1>
                <div >
                    <form class="forma_za_vest" action="" method="POST">
                    <label for="linkSlike">Unesite link za sliku</label>
                    <input class="input_slika" type="text" name="linkSlike" placeholder="Unesite link za sliku..." require>
                    <label for="tekstNaslov">Unesite naslov</label>
                    <input class="input_slika" type="text" name="tekstNaslov" placeholder="Unesite naslov..." require>
                    <label for="tekstTekst">Unesite sadrzaj za vest</label>
                    <input class="input_sadrzaj" type="text" name="tekstTekst" placeholder="Unesite sadrzaj za vest..." require>        
                    <button type="submit" class="addBtn" name="dodavanjeVesti">Dodaj vest</button>
                </form>
                </div>
            </div>
        </div>
    </div>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['dodavanjeVesti']))
        {
            dodajVest();
        }
        function dodajVest(){
            $link = $_POST["linkSlike"];
            $naslov = $_POST["tekstNaslov"];
            $tekst = $_POST["tekstTekst"];
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

            $sql = "INSERT INTO novost (slika, naslov, tekst)
            VALUES ('$link', '$naslov', '$tekst')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Uspesno ste dodali vest!')</script>";
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