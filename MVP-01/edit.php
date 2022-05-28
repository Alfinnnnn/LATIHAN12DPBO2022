<?php
include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");

$pasien = new ProsesPasien();
$nik = null;
$nama = null;
$tempat = null;
$tl = null;
$gender = null;
$genderM = null;
$genderF = null;
$email = null;
$telp = null;


if(isset($_GET['id_hapus'])){
    $pasien->deleteDataPasien($_GET['id_hapus']);
    header('location:index.php');
}if(isset($_GET['id_edit'])){
    $pasien->getWherePasien($_GET['id_edit']);
    $nik = $pasien->getNik(0);
    $nama = $pasien->getNama(0);
    $telp = $pasien->getTelp(0);
    $tempat = $pasien->getTempat(0);
    $tl = $pasien->getTl(0);
    echo $tl;
    $email = $pasien->getEmail(0);
    $gender = $pasien->getGender(0);
    echo $gender;
    if($gender == "Laki-laki"){
        $genderM = "checked";
    }else if($gender == "Perempuan"){
        $genderF = "checked";
    }
    if(isset($_POST['submit'])){
        $pasien->updateDataPasien($_GET['id_edit'], $_POST);
        header('location:index.php');
    }

    
}if(isset($_GET['id_add'])){
    
    if(isset($_POST['submit'])){
        $pasien->addDataPasien($_POST);
        header('location:index.php');
    }
    
}
$tpl = new Template("templates/form.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("NIKK", $nik);
$tpl->replace("NAMA", $nama);
$tpl->replace("TEMPAT", $tempat);
$tpl->replace("TL", $tl);
$tpl->replace("GENDERM", $genderM);
$tpl->replace("GENDERF", $genderF);
$tpl->replace("EMAIL", $email);
$tpl->replace("TELP", $telp);
$tpl->write();
?>