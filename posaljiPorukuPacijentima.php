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
                <h1>Posaljite poruku pacijentima</h1>
                <div class="forma_za_promenu_lozinke_div" >
                    <form class="forma_za_promenu_lozinke" action="" method="POST">
                        <label for="trLozinka">Poruka</label>
                        <textarea id="input_lozinka1" class="input_lozinka" type="text" name="poruka" placeholder="Unesite poruku..." require></textarea>
                        <button type="submit" class="addBtn" name="posaljiPoruku">Posalji poruku</button>
                </form>
                </div>
            </div>
        </div>
    </div>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['posaljiPoruku']))
        {
            posaljiPoruku();
        }
        function posaljiPoruku(){
            $poruka = $_POST["poruka"];
            $korisnickoIme = $_SESSION['zaglavljeEmail'];
            
            $servername = "sql201.epizy.com";
    $username = "epiz_31340445";
    $password = "elBHhIDkeDNVE";
    $dbname = "epiz_31340445_dentalclinic";

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT * FROM korisnici WHERE username = '$korisnickoIme'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $docinMejl = $row['email'];
                $doca = "";
                $doca .= $row['ime'];
                $doca .= " ";
                $doca .= $row['prezime'];

                $sqll = "SELECT email FROM korisnici WHERE izabraniLekar='$doca' AND tip='pacijent'";
                    $resultt = $conn->query($sqll);
                    while($row = $resultt->fetch_assoc())
                    {
                        $mejl = $row['email'];
                        $to = $mejl;
                        $subject = "Obavestenje od Vaseg izabranog lekara";                
                        $message = "<div class='card' style='width: 350px; border: 1px solid grey; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
                            <div class='card_header' style='width: 100%; height: 50px; background-color: rgb(7, 137, 212); padding-left: 5px;padding-top: 2px;'>
                                <div class='logo' style='margin-top: 5px; width: 87px; background-color: white; padding: 7px; border-radius: 15px;'><b>dentalClinic</b></div>
                            </div>
                            <div class='card_content' style='padding: 10px;'>
                                <h4>".$poruka."</h4><br>
                                <h4>Dr ".$doca."</h4>
                            </div>
                        </div>";
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                        // More headers
                        $headers .= 'From: <cdental909@gmail.com>' . "\r\n";
                        $headers .= 'Cc: '.$to.'' . "\r\n";
                        mail($to,$subject,$message,$headers);

                        echo "<script>alert('Uspesno poslali poruku svojim pacijentima!')</script>";
                
                    }

                }
                else{
                echo "<script>alert('Doslo je do greske!')</script>";
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