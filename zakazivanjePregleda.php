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
        <?php include'zakazivanjePregleda.css';?>
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
                    <li><a href="nalsovna.php"><p>NASLOVNA</p></a></li>
                        <li><a href="./nalsovna.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="./nalsovna.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="./nalsovna.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="./nalsovna.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="./nalsovna.php/#footer"><p>KONTAKT</p></a></li>    
                        
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
                                    <li><a href="prikazLicnihInformacija.php">LICNE INFORMACIJE</a></li>
                                    <li><a href="zakazivanjePregleda.php">ZAKAZITE PREGLED</a></li>
                                    <li><a href="istorijaBolesti.php">ISTORIJA BOLESTI</a></li>
                                    <li><a href="promenaSlikePacijent.php">PROMENA PROFILNE FOTOGRAFIJE</a></li>
                                    <li><a href="promenaIzabranogLekara.php">PROMENA IZABRANOG LEKARA</a></li>
                                    <li><a href="promenaLozinkePacijent.php">PROMENA LOZINKE</a></li>
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
                <form method="POST">
                <h1>Zakazite pregled</h1><br>
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
                $korisnickoIme=$_SESSION["zaglavljeEmail"];
                $dDatum = date("Y-m-d");
                $trVreme = date("H:i:sa");
                $sql = "SELECT izabraniLekar FROM korisnici WHERE username='$korisnickoIme'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lekar = $row['izabraniLekar'];
                    $sqll = "SELECT datum, vreme FROM rezervacije WHERE lekar='$lekar' AND statusTermina='slobodan' AND vreme > '$trVreme' OR datum > '$dDatum'";
                    $resultt = $conn->query($sqll);
                    echo "<br><label for='termin'><b>Slobodni termini za Vaseg izabranog lekara:</b></label><br><br>                       
                        <select id='termin' name='termin'>";
                    while($row = $resultt->fetch_assoc())
                    {   
                        echo"<option value='".$row['datum']." ".$row['vreme']."'>".$row['datum']." ".$row['vreme']."</option>";
                    }
                    echo "</select>";
                } else {
                    echo "Jos nema registrovanih korisnika!";
                }
                $conn->close();
                ?>
                <input type="submit" class="addBtn" name="zakaziPregled" value="Zakazite pregled"></input>
            </div>
           </from> 
        </div>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['zakaziPregled']))
        {
            zakaziPregled();
        }
        function zakaziPregled(){
            $termin = $_POST["termin"];
            $terminNiz = explode(" ", $termin);

            $korisnickoIme = $_SESSION['zaglavljeEmail'];
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

            $sql = "UPDATE rezervacije SET pacijent='$korisnickoIme', statusTermina='rezervisan' WHERE vreme='$terminNiz[1]' AND datum = '$terminNiz[0]'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Uspesno ste zakazali pregled!')</script>";
            } else {
                echo "<script>alert('Neuspesno zakazivanje pregleda, probajte ponovo!')</script>";

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