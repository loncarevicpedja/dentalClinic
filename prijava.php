<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Document</title>
    <style>
        <?php include'prijava.css' ?>
    </style>
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
                        <li><a href="#"><p>O NAMA</p></a></li>
                        <li><a href="#"><p>USLUGE</p></a></li>
                        <li><a href="#"><p>OSOBLJE</p></a></li>
                        <li><a href="#"><p>KONTAKT</p></a></li>
                        <li id="prijava"><a href="#"><p>PRIJAVI SE</p></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        function redirect($location)
        {
            header("location: {$location}");
            exit();
        }
        function validate_user_login()
        {
            $errors = [];
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['psw'];
                $typeUser = $_POST['type'];
                if (empty($email)) {
                    $errors[] = "Polje za email ne sme da ostane prazno";
                }
                if (empty($password)) {
                    $errors[] = "Polje za lozinku ne sme da ostane prazno";
                }
                if (empty($errors)) {
                    if (user_login($email, $password)) {
                        if($typeUser == 'pacijent')
                        {
                            redirect('nalsovna.php');
                        }
                        elseif($typeUser == 'lekar'){
                            redirect('nalsovnaLekar.php');
                        }
                        elseif($typeUser == 'admin'){
                            redirect('nalsovnaAdmin.php');
                        }
                    } else {
                        $errors[] = "Neispravan unos, probajte ponovo!";
                    }
                }
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo '<div class="alert">' . $error . '</div>';
                    }
                }
            }        
        }
        function user_login($email, $pass)
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proba";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql = "SELECT * FROM korisnici WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                if (password_verify($pass, $data['lozinka'])) {
                    $_SESSION['zaglavljeEmail'] = $data['email'];
                    return true;
                } else {
                    return false;
                }
            } else {
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
                    <input type="email" placeholder="Unesite korisničko ime" name="email" required>

                    <label for="psw"><b>Lozinka</b></label>
                    <input type="password" placeholder="Unesite lozinku" name="psw" required>
                        
                    <input type="submit" name="login-submit" value="Prijavi se"></input>
                    <div class="registracija">
                        <p>Niste registrovani?</p>
                        <button><a href="./registracija.php">Registruj se</a></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="footer">
            <div class="footer_copyright">
                <p>Copyright ©2022 Dental Clinic. All Right</p>
            </div>
        </div>
    </div>
</body>
</html>