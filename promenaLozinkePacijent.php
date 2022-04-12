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
        <?php include'promenaLozinke.css';?>
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
                <h1>Promena lozinke</h1>
                <div class="forma_za_promenu_lozinke_div" >
                    <form class="forma_za_promenu_lozinke" action="" method="POST">
                        <label for="trLozinka">Unesite trenutnu lozinku</label>
                        <input id="input_lozinka1" class="input_lozinka" type="password" name="trLozinka" placeholder="Unesite trenutnu lozinku..." require>
                        <label for="nLozinka">Unesite novu lozinku</label>
                        <input id="input_lozinka2" class="input_lozinka" type="password" name="nLozinka" placeholder="Unesite novu lozinku..." require>
                        <label for="nLozinkaPotvrda">Potvrdite novu lozinku</label>
                        <input id="input_lozinka3" class="input_lozinka" type="password" name="nLozinkaPotvrda" placeholder="Potvrdite novu lozinku..." require>        
                        <input type="checkbox" onclick="showPasswords()">Prikazi lozinke
                        <button type="submit" class="addBtn" name="promenaLozinke">Promeni lozinku</button>
                </form>
                </div>
            </div>
        </div>
    </div>
        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['promenaLozinke']))
        {
            promeniLozinku();
        }
        function promeniLozinku(){
            $trLozinka = $_POST["trLozinka"];
            $nLozinka = $_POST["nLozinka"];
            $nLozinkaPotvrda = $_POST["nLozinkaPotvrda"];
            $korisnickoIme = $_SESSION['zaglavljeEmail'];
            $servername = "localhost";
    $username = "id18650421_dentalclinicc";
    $password = "Predrag21.07.2000.";
    $dbname = "id18650421_dentalclinic";

            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "SELECT * FROM korisnici WHERE username = '$korisnickoIme'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if(password_verify($trLozinka, $row['lozinka']) )
                {
                    if($trLozinka != $nLozinka && $trLozinka !=$nLozinkaPotvrda){

                        if($nLozinka == $nLozinkaPotvrda)
                        {
                            $nLozinkaHash = password_hash($nLozinka, PASSWORD_DEFAULT);
                            $sql = "UPDATE korisnici SET lozinka='$nLozinkaHash' WHERE username='$korisnickoIme'";
    
                            if ($conn->query($sql) === TRUE) {
                                echo "<script>alert('Uspesno ste izmenili lozinku!')</script>";
                            } else {
                                echo "<script>alert('Neuspesna izmena lozinke!')</script>";
                            }
                        }
                        else{
                            echo "<script>alert('Nova lozinka se razlikuje od potvrdjene!')</script>";
                        }
                    }
                    else{
                    echo "<script>alert('Neispravno unesena trnutna lozinka')</script>";
                    }
                }
                else{
                echo "<script>alert('Nova lozinka se mora razlikovati od trenutne!')</script>";
                }


                
            }
            $conn->close();

         }
            
        ?>
    <script>
        function openMenu() {
            document.getElementById("reg_meni").classList.toggle("show");
            document.getElementById("imagee").classList.toggle("zatamni");
        }
        function showPasswords(){
            showPassword("input_lozinka1")
            showPassword("input_lozinka2")
            showPassword("input_lozinka3")
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