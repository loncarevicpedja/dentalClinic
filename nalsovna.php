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
    <title>Dental clinic</title>
    <style>
        <?php include'naslovna.css';?>
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
                        <li><a href="http://localhost/projekat/nalsovna.php/#novosti"><p>VESTI</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/#o_nama"><p>O NAMA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/#nas_tim"><p>OSOBLJE</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/#galerija"><p>GALERIJA</p></a></li>
                        <li><a href="http://localhost/projekat/nalsovna.php/#footer"><p>KONTAKT</p></a></li>
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
                                    <li><a href="zakazivanjePregleda.php">ZAKAZITE PREGLED</a></li>
                                    <li><a href="istorijaBolesti.php">ISTORIJA BOLESTI</a></li>
                                    <li><a href="promenaLozinkePacijent.php">PROMENA LOZINKE</a></li>
                                    <li id="odjava"><a href="./logout.php">ODJAVITE SE<i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="image">
                <img id="imagee" class="slika" src="https://belvilledental.com/wp-content/uploads/2019/12/ordinacija-popravka-zuba-stomatolog-asistent-2.jpg" alt="">
            </div>
        </div>
        <div class="contetnt">
        <div id="imagee" class="contetnt">
            <div id="novosti" class="novosti">
                <h1>Poslednje vesti</h1>  
                <?php
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

                $sql = "SELECT slika, naslov, tekst FROM novost";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='novosti_kartica'>
                        <div class='kartica_slika'>
                            <img src='".$row["slika"]."'>
                        </div>
                        <div class='kartica_sadrzaj'>
                            <div class='kartica_naslov'>
                                <h2>".$row["naslov"]."</h2>
                            </div>
                            <div class='kartica_tekst'>
                                <p>".$row["tekst"]."</p>
                            </div>
                        </div>
                    </div>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </div>
            <div id="o_nama" class="o_nama">
                <div class="o_nama_sadrzaj">
                    <div class="o_nama_naslov">
                        <h1>O nama</h1>
                    </div>
                    <div class="o_nama_tekst">
                        <p>Stomatološka ordinacija Dental Clinic osnovana je 1998, a za gotovo dve decenije postojanja postala je sinonim za profesionalno, stručno i vrhunsko pružanje svih vrsta stomatoloških usluga. Osnivač Dental Clinic je dr Vesna Lazić, specijalista stomatološke protetike sa dugogodišnjim iskustvom u radu sa bezmetalnom keramikom, protetikom na implantatima i sanaciji svih vrsta poremećaja zagrižaja, stručnjak u estetskoj restaurativnoj stomatologiji i primeni CAD/CAM tehnologije. U ordinaciji Dental Clinic možete dobiti sve vrste stomatoloških usluga (terapija laserom, estetski ispuni, beljenje zuba, CAD/CAM, fasete, implantologija, oralna hirurgija, protetika, parodontologija, ortodoncija i endodoncija), koje su u dosluhu sa svim najsavremenijim svetskim metodama u ovoj medicinskoj oblasti i uz korišćenje najboljih stomatoloških alata i materijala. Prvi pregled je besplatan, na kojem ćete saznati sve o svom stomatološkom problemu, istovremeno i dobiti informaciju o metodama i načinima kako se on može rešiti i to na što efikasniji i bezbolniji način.</p>
                    </div>
                </div>
                <div class="o_nama_slika">
                    <img src="https://www.marcusdblackdds.com/wp-content/uploads/2020/04/difference-between-endodontist-vs-dentist.jpg" alt="">
                </div>
            </div>
            <div id="nas_tim" class="nas_tim">
                <h1>Naš tim</h1>
                <div class="kartice_doktor">
                <?php
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

                $sql = "SELECT ime, prezime, slika FROM korisnici WHERE tip = 'lekar'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='nas_tim_kartica'>
                        <div class='doktor_slika'>
                            <img src='".$row["slika"]."'> 
                        </div>
                        <div class='doktor_ime'>
                            <h2>Dr ".$row["ime"]." ".$row['prezime']."</h2>
                        </div>
                    </div>";
                        }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
                
                </div>  
            </div>
            <div id="galerija" class="galerija">
                <div class="galerija_naslov">
                    <h1>Galerija</h1>
                </div>
                <div class="galerija_slike">
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789299821_10.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300581_19.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300401_17.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300271_15.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300191_14.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300011_12.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300331_16.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300401_17.jpg" alt="">
                    </div>
                    <div class="slika_okvir">
                        <img src="https://dental-clinic.rs/portal/foto/14789300501_18.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
        <div id="footer" class="footer">
                <div class="footer_info">
                    <div class="footer_logo_kontakt">
                        <div class="logo2">
                            <div class="prvi">                            
                                <p class="logo2_font">dental</p>
                            </div>
                            <div class="drugi">
                                <i class="fas fa-tooth"></i>
                            </div>
                            <div class="treci">
                                <p c lass="logo2_font">clinic</p>
                            </div>
                        </div>
                        <div class="informacije">
                            <div class="adresa">
                            <p>Sokobanjska 3, 11000 Beograd, Srbija</p>
                            </div>
                            <div class="telefon">
                            <i class="fas fa-phone"></i>
                            <p>+381 11 3671 133</p>
                            </div>
                            <div class="telefon1">
                            <i class="fas fa-phone"></i>
                            <p>+381 11 3671 133</p>
                            </div>
                            <div class="mail">
                            <i class="far fa-envelope"></i>
                            <p>loncarevicpedja2000@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="zakazite_pregled">
                        <h2>ZAKAŽITE BESPLATAN PREGLED</h2>
                        <hr>
                        <p>Prvi pregled u stomatološkoj ordinaciji Dental Clinic je besplatan. Pregledom ćete saznati sve o Vašem stomatološkom problemu i kako ga rešiti. U toku pregleda se dobija informacija kojim sve metodama i na koji nacin se može rešiti problem u Vašim ustima. I na kraju se može dobiti obaveštenje o ceni stomatoloških usluga.</p>
                        <button class="button-18" role="button">ZAKAŽITE PREGLED</button>
                    </div>
                    <div class="lokacija">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2831.9075546262457!2d20.460219414923678!3d44.782689986679095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7041aad2322b%3A0x2f62ab55af9c1698!2sSokobanjska%203%2C%20Beograd!5e0!3m2!1sbs!2srs!4v1641391481344!5m2!1sbs!2srs" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="footer_copyright">
                        <p>Copyright ©2022 Dental Clinic. All Right</p>
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