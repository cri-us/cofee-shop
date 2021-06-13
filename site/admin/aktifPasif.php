<?php
if ($_POST) { //post var mı diye bakıyoruz
    include("../inc/vt.php"); //veri tabanına bağlanıyoruz

    //değişkenleri integer olarak alıyoruz
    $id = (int)$_POST['id'];
    $durum = (int)$_POST['durum'];


    $satir = array('id' => $id,
        'durum' => $durum,
    );
    // Veri güncelleme sorgumuzu yazıyoruz.
    $sql = "UPDATE urunler SET aktif=:durum WHERE id=:id;";
    $durum = $baglanti->prepare($sql)->execute($satir);


    //gerekli ise geriye değer döndürüyoruz
    echo $id . " nolu kayıt değiştirildi2";
}
?>