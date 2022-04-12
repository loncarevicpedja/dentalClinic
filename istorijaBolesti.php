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
        <?php include'istorijaBolesti.css';?>
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
                <h1>Istorija bolesti</h1><br>
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
                $sql = "SELECT * FROM kartoni WHERE pacijent = '$korisnickoIme'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                                                
                        echo "<form method='POST'>
                        <div class='kartica'>
                        <h3>Dijagnoza:</h3>
                        <p>".$row["dijagnoza"]."</p>
                        <h3>Anamneza:</h3>
                        <p>".$row["anamneza"]."</p>
                        <h3>Status:</h3>
                        <p>".$row["statusP"]."</p>
                        <h3>Terapija:</h3>
                        <p>".$row["terapija"]."</p>
                        <h3>Napomena:</h3>
                        <p>".$row["napomena"]."</p>
                    </div><hr>
                </form>";
                    }
                } else {
                    echo "Nemate istoriju bolesti!";
                }
                $conn->close();
                ?>
            </div>
           </from> 
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