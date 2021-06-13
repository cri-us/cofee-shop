<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<?php
$sayfa = "Hakkımızda";
include('../inc/vt.php');
include('inc/head.php');
include('inc/nav.php');
include('inc/sidebar.php');

$sorgu = $baglanti->prepare("SELECT * FROM hakkimizda Where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor


       if ($_POST) { // Post olup olmadığını kontrol ediyoruz.

    $ustBaslik = $_POST['ustBaslik']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $hata = '';



    if ($_FILES["foto"]["name"] != "") {
        $foto = strtolower($_FILES['foto']['name']);
        if (file_exists('images/' . $foto)) {
            $hata = "$foto diye bir dosya var";
        } else {
            $boyut = $_FILES['foto']['size'];
            if ($boyut > (1024 * 1024 * 2)) {
                $hata = 'Dosya boyutu 2MB den büyük olamaz.';
            } else {
                $dosya_tipi = $_FILES['foto']['type'];
                $dosya_uzanti = explode('.', $foto);
                $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];

                if (!in_array($dosya_tipi, ['image/png', 'image/jpeg']) || !in_array($dosya_uzanti, ['png', 'jpg'])) {
                            //if (($dosya_tipi != 'image/png' || $dosya_uzanti != 'png' )&&( $dosya_tipi != 'image/jpeg' || $dosya_uzanti != 'jpg')) {
                    $hata = 'Hata, dosya türü JPEG veya PNG olmalı.';
                } else {
                    $dosya = $_FILES["foto"]["tmp_name"];
                    copy($dosya, "../img/" . $foto);
                            unlink('../img/' . $sonuc["foto"]); //eski dosya siliniyor.
                        }
                    }
                }
            } else {
                //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki resimi değiştirmiyoruz
                $foto = $sonuc["foto"];
            }

            if ($ustBaslik <> "" && $icerik <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                //Değişecek veriler
                $satir = [

                    'id' => $_GET['id'],
                    'foto' =>$foto,
                    'ustBaslik' => $ustBaslik,
                    'baslik' => $baslik,
                    'icerik' => $icerik,
                ];
                // Veri güncelleme sorgumuzu yazıyoruz.
                $sql = "UPDATE hakkimizda SET foto=:foto, ustBaslik=:ustBaslik, baslik=:baslik,  icerik=:icerik WHERE id=:id;";   
                $durum = $baglanti->prepare($sql)->execute($satir);

                if ($durum)
                {
                   echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "hakkimizda.php"});
                   </script>';

                     // Eğer güncelleme sorgusu çalıştıysa index.php sayfasına yönlendiriyoruz.
               } else {
                    echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
                }
            } else {
                echo 'Hata oluştu: ' . $hata; // dosya hatası ve form elemanlarının boş olma durumunua göre hata döndürüyoruz.
            }
            if ($hata != "") {
                echo '<script>swal("Hata","' . $hata . '","error");</script>';
            }
        }





        ?>
        <script src="vendor/CKEditor5/ckeditor.js"></script>
        <div id="content-wrapper">

            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Hakkımızda Düzenle</li>
                </ol>


                <!-- DataTables Example -->
                <div class="card mb-3">

                    <div class="card-body">

                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <img src="../img/<?= $sonuc["foto"] ?>" width="150" alt="">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control-file" id="foto">
                            </div>
                            <div class="form-group">
                                <label>Üst Başlık</label>
                                <input required type="text" value="<?= $sonuc["ustBaslik"] ?>" class="form-control" name="ustBaslik"
                                placeholder="Üst başlık">
                            </div>

                            <div class="form-group">
                                <label>Başlık</label>
                                <input required type="text" value="<?= $sonuc["baslik"] ?>" class="form-control" name="baslik"
                                placeholder="Başlık">
                            </div>

                            <div class="form-group">
                                <label for="ustIcerik">İçerik</label>
                                <textarea  name="icerik" id="icerik">
                                    <?= $sonuc["icerik"] ?>
                                </textarea>

                                <script>
                                    ClassicEditor
                                    .create(document.querySelector('#icerik'))
                                    .then(editor => {
                                        console.log(editor);
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                                </script>

                            </div>





                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </div>

                        </form>


                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>


                <!-- /.container-fluid -->


                <script>
                    $(document).ready(function () {
                        $('#dataTable').DataTable({
                            language: {
                                info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                                infoEmpty: "Gösterilecek hiç kayıt yok.",
                                loadingRecords: "Kayıtlar yükleniyor.",
                                zeroRecords: "Tablo boş",
                                search: "Arama:",
                                sLengthMenu: "Sayfada _MENU_ kayıt göster",
                                infoFiltered: "(toplam _MAX_ kayıttan filtrelenenler)",
                                buttons: {
                                    copyTitle: "Panoya kopyalandı.",
                                    copySuccess: "Panoya %d satır kopyalandı",
                                    copy: "Kopyala",
                                    print: "Yazdır",
                                },

                                paginate: {
                                    first: "İlk",
                                    previous: "Önceki",
                                    next: "Sonraki",
                                    last: "Son"
                                },
                            }
                        });
                    });

                </script>
                <script src="js/aktifcustom.js"></script>
                <link rel="stylesheet" type="text/css" href="css/switch.css">