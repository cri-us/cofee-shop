<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
<?php
session_start(); //oturum başlattık
include("../inc/vt.php"); //veri tabanına bağlandık 

//eğer mevcut oturum varsa sayfayı yönlendiriyoruz.
if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "6789") {
    header("location:index.php");
} //eğer önceden beni hatırla işaretlenmiş ise oturum oluşturup sayfayı yönlendiriyoruz.
else if (isset($_COOKIE["cerez"])) {
    //Kullanıcı adlarını çeken sorgumuz

    $sorgu = $baglanti->prepare("select kadi from kullanicilar");
    $sorgu->execute();


    //Kullanıcı adlarını döngü yardımı ile tek tek elde ediyoruz
    while ($sonuc = $sorgu->fetch()) {
        //eğer bizim belirlediğimiz yapıya uygun kullanıcı var mı diye bakıyoruz.
        if ($_COOKIE["cerez"] == md5("aa" . $sonuc['kadi'] . "bb")) {

            //oturum oluşturma buradaki değerleri güvenlik açısından
            //farklı değerler yapabilirsiniz
            //aynı zamanda kullanıcı adınıda burada tuttum
            $_SESSION["Oturum"] = "6789";
            $_SESSION["kadi"] = $sonuc['kadi'];

            //sonrasında index sayfasına yönlendiriyorum
            header("location:index.php");
        }
    }
}
//Giriş formu doldurulmuşsa kontrol ediyoruz
if ($_POST) {
    $txtKadi = $_POST["txtKadi"]; //Kullanıcı adını değişkene atadık
    $txtParola = $_POST["txtParola"]; //Parolayı değişkene atadık
}
?>
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <form id="form1" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" name="txtKadi" value='<?php echo @$txtKadi ?>' id="inputKadi"
                               class="form-control" placeholder="Email address" required autofocus>
                        <label for="inputKadi">Kullanıcı Adı</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required
                               name="txtParola">
                        <label for="inputPassword">Parola</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ID="ckbHatirla" name="ckbHatirla"/>
                            Beni hatırla
                        </label>
                        <br>
                        <?php
                        //Post varsa yani submit yapılmışsa veri tabanından kontrolü yapıyoruz.
                        if ($_POST) {
                            //sorguda kullanıcı adını alıp ona karşılık parola var mı diye bakıyoruz.
                            $sorgu = $baglanti->prepare("select parola from kullanicilar where kadi=:kadi");
                            $sorgu->execute(array('kadi' => htmlspecialchars($txtKadi)));
                            $sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor


                            //parolaları md5 ile şifreledim ve başına sonuna kendimce eklemeler yaptım.
                            if (md5("56" . $txtParola . "23") == $sonuc["parola"]) {
                                $_SESSION["Oturum"] = "6789"; //oturum oluşturma
                                $_SESSION["kadi"] = $txtKadi;

                                //eğer beni hatırla seçilmiş ise cookie oluşturuyoruz.
                                //cookie de şifreleyerek kullanıcı adından oluşturdum
                                if (isset($_POST["ckbHatirla"])) {
                                    setcookie("cerez", md5("aa" . $txtKadi . "bb"), time() + (60 * 60 * 24 * 7));
                                }
                                header("location:index.php"); //sayfa yönlendirme
                            } else {
                                //eğer kullanıcı adı ve parola doğru girilmemiş ise
                                //hata mesajı verdiriyoruz
                                echo "Kullanıcı adı veya parola yanlış!";
                            }
                        }
                        ?>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary btn-block" ID="btnGiris" value="Giriş"/>
            </form>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
