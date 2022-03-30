<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pregled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">    
    <title>Dental clinic</title>
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
                <h1>Pregled</h1>
                <form class="forma" action="" method="POST">
                <div class="forma_div" >
                        <br><br><p><?php echo date('Y-m-d'); ?></p>
        <?php
                $maticni = $_SESSION["jmbg"];            
                $servername = "sql201.epizy.com";
    $username = "epiz_31340445";
    $password = "elBHhIDkeDNVE";
    $dbname = "epiz_31340445_dentalclinic";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM korisnici WHERE jmbg='$maticni' ";
                $result = $conn->query($sql);

                    while($row = $result->fetch_assoc())
                    {   
                        $_POST["pacijent"]=$row["username"];
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
                            </div>
                        </form>";
                            }
                $conn->close();            
        ?>
                <div class="istorija">
                    <h2>Istorija bolesti</h2>
                    <div class="istorija_bolesti">
                    <?php
                    $bolesnik = $_POST["pacijent"];
                    $servername = "sql201.epizy.com";
    $username = "epiz_31340445";
    $password = "elBHhIDkeDNVE";
    $dbname = "epiz_31340445_dentalclinic";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "SELECT * FROM kartoni WHERE pacijent = '$bolesnik'";
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
                    echo "Dati pacijent nema istoriju bolesti!";
                }
                $conn->close();
                ?>
                    </div>
                </div>
                <div class="raspored">
                        <label for="opis"><b>Dijagnoza</b></label>
                        <input type="text" placeholder="Dijagnoza..." name="dijagnoza" id="dijagnoza" required></input>
                </div>
                <div class="raspored">
                        <label for="opis"><b>Anamneza</b></label>
                        <textarea type="text" placeholder="Anamneza..." name="anamneza" id="anamneza" required></textarea>
                </div>
                <div class="raspored">
                        <label for="opis"><b>Status</b></label>
                        <textarea type="text" placeholder="Status..." name="status" id="status" required></textarea>
                </div>
                <div class="raspored">
                        <label for="opis"><b>Terapija</b></label>
                        <textarea type="text" placeholder="Terapija..." name="terapija" id="terapija" required></textarea>
                </div>
                <div class="raspored">
                        <label for="opis"><b>Napomena</b></label>
                        <textarea type="text" placeholder="Napomena..." name="napomena" id="napomena" required></textarea>
                </div>
                <button type="submit" class="addBtn" name="snimiPregled">Snimi pregled</button>
            </form>
                </div>
                <?php 
                    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['snimiPregled']))
                    {
                        snimiPregled();
                    }
                    function snimiPregled(){
                        $pacijent= $_POST["pacijent"]; 
                        $dijagnoza = $_POST["dijagnoza"];
                        $anamneza = $_POST["anamneza"];
                        $statusP = $_POST["status"];
                        $terapija =$_POST["terapija"];
                        $napomena =$_POST["napomena"];
                        $datum = date('Y-m-d');
                        $vreme = strval(date("H:0:0"));
                        $lekar = $_SESSION['zaglavljeEmail'];
                        $servername = "sql201.epizy.com";
    $username = "epiz_31340445";
    $password = "elBHhIDkeDNVE";
    $dbname = "epiz_31340445_dentalclinic";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 

                        $sql = "INSERT INTO kartoni (datum, vreme, pacijent, lekar, dijagnoza, anamneza, statusP, terapija, napomena)
                        VALUES ('$datum', '$vreme', '$pacijent', '$lekar', '$dijagnoza', '$anamneza', '$statusP', '$terapija', '$napomena')";

                        if ($conn->query($sql) === TRUE) {
                            $sqll = "UPDATE rezervacije SET statusTermina='obavljen' WHERE datum='$datum' AND vreme='$vreme'";
                            if ($conn->query($sqll) === TRUE) {
                                echo "<script>alert('Uspesno snimljen pregled!')</script>";
                            } else {
                                echo "<script>alert('Nemoguca promena statusa pregleda zbog vremena!')</script>";

                            }
                        } else {
                            echo "<script>alert('Nespesno snimljen pregled!')</script>";
                        }

                        $conn->close();


                    }
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