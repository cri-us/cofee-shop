<?php
$sayfa = 'İletişim';
include('inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
?>
    <br>
    <br>
    <br>
    <section class="page-section about-heading">
        <div class="container">

            <div class="about-heading-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="bg-faded rounded p-5">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">İLETİŞİM</span>
                            </h2>

                            <form action="iletisim" method="POST">

                                <div class="form-group">
                                    <input type="text" name="ad" required class="form-control px-3 py-3"
                                           placeholder="Adınız">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" required class="form-control px-3 py-3"
                                           placeholder="Email Adresiniz">
                                </div>
                                <div class="form-group">
                                <textarea name="mesaj" cols="30" required rows="7" class="form-control px-3 py-3"
                                          placeholder="Mesaj"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Gönder" class="btn btn-primary py-3 px-5">
                                    <script type="text/javascript" src="js/sweetalert.min.js"></script>
                                    <?php

                                    if ($_POST) {

                                        $kaydet = $baglanti->prepare("INSERT INTO iletisim SET ad=:ad, email=:email, mesaj=:mesaj");
                                        $insert = $kaydet->execute(array(
                                            'ad' => htmlspecialchars($_POST['ad']),
                                            'email' => htmlspecialchars($_POST['email']),
                                            'mesaj' => htmlspecialchars($_POST['mesaj']),
                                        ));
                                        if ($insert) {

                                            echo '<script>swal("Başarılı","Mesajınız bize ulaştı","success");</script>';
                                        } else {
                                            echo '<script>swal("Hata","Daha sonra tekrar deneyin","error");</script>';
                                        }
                                    }

                                    ?>


                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php


include('inc/footer.php');
?>