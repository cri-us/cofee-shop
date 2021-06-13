<?php
session_start();
session_destroy();
setcookie("cerez", md5("aa" . $txtKadi . "bb"), time() - 1);

header("location:index.php");

?>