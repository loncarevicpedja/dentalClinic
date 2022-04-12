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
        <?php include'promenaRasporeda.css';?>
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
                    <li><a href="nalsovnaLekar.php"><p>NASLOVNA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaLekar.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaLekar.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaLekar.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaLekar.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovnaLekar.php/#footer"><p>KONTAKT</p></a></li>
                        
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
                <h1>Promena</h1>
                <div class="forma_div" >
                    <form class="forma" action="" method="POST">
                        <input name="datum" type="date"/>
                        <button type="submit" class="addBtn" name="prikazi">Prikazi</button>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prikazi']))
        {
            prikaziPacijente();
        }
        function prikaziPacijente(){
            $vreme = $_POST['datum'];
            $_SESSION['nesto'] = $vreme;
            $lekar = $_SESSION['zaglavljeEmail'];
            
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
                $korisnickoIme=$_SESSION["zaglavljeEmail"];
                $ddatum = $_POST['datum'];
                $sql = "SELECT * FROM raspored WHERE datum = '$ddatum'";
                $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $datuum = $row["datum"];
                            echo "<form method='POST'>
                                <div class='kartica'>
                                <h3>Datum:</h3>
                                <p>".$row["datum"]."</p>
                                <h3>I smena:</h3>
                                <p>".$row["Ismena"]."</p>
                                <h3>II smena:</h3>
                                <p>".$row["IIsmena"]."</p>
                            </div>
                        </form>";
                            }
            }
        ?>
        <h3>Promena</h3>
        <form method="POST">
            <label for="smena"><b>Smena</b></label><br>
            <select id="smena" name="smena">
                <option value="Ismena">I smena</option>
                <option value="IIsmena">II smena</option>
            </select><br>
            
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
                        
                    echo "<label for='izabraniLekarI'><b>I smena:</b></label><br>                        
                        <select id='izabraniLekarI' name='izabraniLekarI'>";
                        while($row = $result->fetch_assoc()) {
                                    echo"<option value='".$row['ime']." ".$row['prezime']."'>".$row['ime']." ".$row['prezime']."</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "0 results";
                    }
                    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['promena']))
                        {
                           promena();
                        }
                    function promena(){
                        $odabraniDatum = $_SESSION['nesto'];
                        $Ismena = $_POST['izabraniLekarI'];
                        $smena = $_POST['smena'];
                        
                        $servername = "localhost";
                    $username = "id18650421_dentalclinicc";
                    $password = "Predrag21.07.2000.";
                    $dbname = "id18650421_dentalclinic";                
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        $sql = "UPDATE raspored SET $smena='$Ismena' WHERE datum='$odabraniDatum'";
                        if ($conn->query($sql) === TRUE) {
                            $sqll = "UPDATE rezervacije SET lekar='$Ismena' WHERE datum='$odabraniDatum'";
                            if ($conn->query($sqll) === TRUE) {
                            echo "<script>alert('Uspesno izmenjen raspored!')</script>";
                            }
                        } else {
                            echo "<script>alert('Neuspesno izmenjen raspored!')</script>";
                        }
                    
                    
                }
            ?>
                        <button type="submit" class="changeBtn" name="promena">Promeni</button>
                </form>
                </div>
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