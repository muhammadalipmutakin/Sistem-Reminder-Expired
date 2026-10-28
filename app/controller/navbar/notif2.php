<?php
include '../conf/config.php';

$currentDate = date('Y-m-d'); // Tanggal saat ini

$queryApproaching = "SELECT COUNT(*) as approachingCount FROM tb_inputexpired WHERE tgl_tarik <= '$currentDate' AND tgl_expired > '$currentDate'";
$resultApproaching = $koneksi->query($queryApproaching);
$rowApproaching = $resultApproaching->fetch_assoc();
$approachingCount = $rowApproaching['approachingCount'];

$queryExpired = "SELECT COUNT(*) as expiredCount FROM tb_inputexpired WHERE tgl_expired < '$currentDate'";
$resultExpired = $koneksi->query($queryExpired);
$rowExpired = $resultExpired->fetch_assoc();
$expiredCount = $rowExpired['expiredCount'];

$notificationsHeader = $approachingCount + $expiredCount;

$response = array(
    'approachingCount' => $approachingCount,
    'expiredCount' => $expiredCount,
    'notificationsHeader' => $notificationsHeader
);

header('Content-Type: application/json');
echo json_encode($response);

$koneksi->close();
?>
