<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./prijava.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="icon.ico" type="image/x-icon">    
    <title>Dental clinic</title>
    
</head>
<body>
    <div class="container">
        <div class="heaad">
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
                        
                        <li id="prijava"><a href="#"><p>PRIJAVI SE</p></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        // function redirect($location)
        // {
        //     header("location: {$location}");
        //     exit();
        // }
        function validate_user_login()
        {
            $errors = [];
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $korisnickoIme = $_POST['uname'];
                $password = $_POST['psw'];
                $typeUser = $_POST['type'];
                if (empty($korisnickoIme)) {
                    $errors[] = "Polje za email ne sme da ostane prazno";
                }
                if (empty($password)) {
                    $errors[] = "Polje za lozinku ne sme da ostane prazno";
                }
                if (empty($errors)) {
                    $tip = user_login($korisnickoIme, $password);
                    if($tip == $typeUser)
                    {
                        if (user_login($korisnickoIme, $password) !== false) {
                            if($typeUser == 'pacijent')
                            {
                                // redirect('nalsovna.php');
                                echo '<meta http-equiv="refresh" content="0; URL=nalsovna.php">';
                            }
                            elseif($typeUser == 'lekar'){
                                // redirect('nalsovnaLekar.php');
                                echo '<meta http-equiv="refresh" content="0; URL=nalsovnaLekar.php">';
                            }
                            elseif($typeUser == 'admin'){
                                // redirect('nalsovnaAdmin.php');
                                echo '<meta http-equiv="refresh" content="0; URL=nalsovnaAdmin.php">';
                            }
                        } else {
                            echo "<script>alert('Neispravan unos, probajte ponovo!')</script>";
                        }
                    }
                }
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<script>alert('".$error."')</script>";
                        echo "<script>alert('Neispravan unos, probajte ponovo!')</script>";
                    }
                }
            }        
        }
        function user_login($korisnickoIme, $pass)
        {
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
            
            $sql = "SELECT * FROM korisnici WHERE username = '$korisnickoIme'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                if (password_verify($pass, $data['lozinka'])) {
                    $_SESSION['zaglavljeEmail'] = $data['username'];
                    return $data['tip'];
                } else {
                    echo "<script>alert('Neispravan unos, probajte ponovo!')</script>";
                    return false;
                }
            } else {
                echo "<script>alert('Neispravan unos, probajte ponovo!')</script>";
                return false;
            }
            $conn->close();
        }
        validate_user_login();        
        ?>
        <div class="content">
            <form method="POST">
                <div class="cont">
                    <label><b>Tip naloga</b></label><br>
                    <select name="type" id="">
                        <option value="pacijent">Pacijent</option>
                        <option value="lekar">Lekar</option>
                        <option value="admin">Admin</option>
                    </select><br>

                    <label for="uname"><b>Korisničko ime</b></label>
                    <input type="text" placeholder="Unesite korisničko ime" name="uname" required>

                    <label for="psw"><b>Lozinka</b></label>
                    <input type="password" placeholder="Unesite lozinku" name="psw" required>
                        
                    <input type="submit" name="login-submit" value="Prijavi se"></input>
                </div>
            </form>
            <div class="registracija">
                <p>Niste registrovani?</p>
                <button><a href="./registracija.php">Registruj se</a></button>
            </div>
        </div>
        <div class="footer">
            <div class="footer_copyright">
                <p>Copyright ©2022 Dental Clinic. All Right</p>
            </div>
        </div>
    </div>
</body>
</html>