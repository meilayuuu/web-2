<?php
$proses = $_POST['proses'];
$nama_siswa = $_POST['nama'];
$mata_kuliah = $_POST['matkul'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_uas = $_POST['nilai_uas'];
$nilai_tugas = $_POST['nilai_tugas'];

if (!empty($proses)) {
    $nilai_total = ($nilai_uts * 0.30) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);
    
    if ($nilai_total > 55) {
        $status = "Selamat Anda Lulus!";
    } else {
        $status = "Maaf, Anda Belom Lulus!";
    }

    if ($nilai_total >= 0 && $nilai_total <= 35) {
        $grade = "E";
    } elseif ($nilai_total >= 36 && $nilai_total <= 55) {
        $grade = "D";
    } elseif ($nilai_total >= 56 && $nilai_total <= 69) {
        $grade = "C";
    } elseif ($nilai_total >= 70 && $nilai_total <= 84) {
        $grade = "B";
    } elseif ($nilai_total >= 85 && $nilai_total <= 100) {
        $grade = "A";
    } else {
        $grade = "I";
    }

switch ($grade) {
    case 'E':
        $predikat = "Sangat Kurang";
        break;
    case 'D':
        $predikat = "Kurang";
        break;
    case 'C':
        $predikat = "Cukup";
        break;
    case 'B':
        $predikat = "Memuaskan";
        break;
    case 'A':
        $predikat = "Sangat Memuaskan";
        break;
    default:
        $predikat = "Grade Tidak Valid";
        break;
}

    echo 'Proses : '. $proses;
    echo '<br/>Nama : '. $nama_siswa;
    echo '<br/>Mata Kuliah : '. $mata_kuliah;
    echo '<br/Nilai UTS : '. $nilai_uts;
    echo '<br/Nilai UAS : '. $nilai_uas;
    echo '<br/Nilai Tugas Praktikum : '. $nilai_tugas;
    echo '<br/Nilai Akhir : '. number_format($nilai_total, 2, ',', '.');
    echo '<br/Status : '. $status;
    echo '<br/Grade : '. $grade;
    echo '<br/Predikat : '. $predikat;
}
?>