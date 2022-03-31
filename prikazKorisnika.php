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
                <h1>Prikaz korisnika</h1>
                <?php
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

                $sql = "SELECT * FROM korisnici WHERE tip='pacijent'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $_SESSION['jmbg'] = $row['jmbg'];;
                        echo "<form method='POST'>
                        <div class='kartica'>
                        <img src='".$row["slika"]."' class='profSl'>
                        <h3>Ime:</h3>
                        <p>".$row["ime"]."</p>
                        <h3>Prezime:</h3>
                        <p>".$row["prezime"]."</p>
                        <h3>Pol:</h3>
                        <p>".$row["pol"]."</p>
                        <h3>Mesto rodjenja:</h3>
                        <p>".$row["mesto_rodjenja"].", ".$row["drzava_rodjenja"]."</p>
                        <h3>Datum rodjenja:</h3>
                        <p>".$row["datum_rodjenja"]."</p>
                        <h3>JMBG:</h3>
                        <p>".$row["jmbg"]."</p>
                        <h3>Email:</h3>
                        <p>".$row["email"]."</p>
                        <div class='ikonice'>
                            <a href='brisiKorisnika.php'  value='".$_SESSION["jmbg"]."'><i class='fa-regular fa-circle-xmark'></i></a>
                        </div>
                    </div>
                </form>";
                    }
                } else {
                    echo "Jos nema registrovanih korisnika!";
                }
                $conn->close();
                ?>
                
            </div>
        </div>
    </div>
    <script>
        function openMenu() {
            document.getElementById("reg_meni").classList.toggle("show");
            document.getElementById("imagee").classList.toggle("zatamni");
        }
    </script>
</body>
</html>