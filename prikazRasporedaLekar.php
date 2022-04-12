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
        <?php include'posaljiPorukuPacijentima.css';?>
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
                        <li><a href="./nalsovnaLekar.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="./nalsovnaLekar.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="./nalsovnaLekar.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="./nalsovnaLekar.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="./nalsovnaLekar.php/#footer"><p>KONTAKT</p></a></li>    
                        
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
                                    <li><a href="prikazLicnihInformacijaLekar.php">PRIKAZ LICNIH INFORMACIJA</a></li>
                                    <li><a href="prikazPacijentaPoDanu.php">PRIKAZ PREGLEDA ZAKAZANIH ZA DANAS</a></li>
                                    <li><a href="prikazPacijenataLekar.php">PRIKAZ PACIJENATA</a></li>
                                    <li><a href="posaljiPorukuPacijentima.php">POSALJI PORUKU PACIJENTIMA</a></li>
                                    <li><a href="posaljiPorukuAdminu.php">POSALJI PORUKU ADMINISTRATORU</a></li>
                                    <li><a href="promenaSlikeLekar.php">PROMENA PROFILNE SLIKE</a></li>
                                    <li><a href="promenaLozinkeLekar.php">PROMENA LOZINKE</a></li>
                                    <li><a href="prikazRasporedaLekar.php">RASPORED RADA</a></li>
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
                <h1>Raspored rada po smenama</h1>
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
                
                $sql = "SELECT * FROM raspored";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<table><tr><th>Datum</th><th>I smena</th><th>II smena</th></tr>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["datum"]."</td><td>".$row["Ismena"]."</td><td>".$row["IIsmena"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
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