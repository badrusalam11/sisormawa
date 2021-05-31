<?php
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',14);
// cetak logo
// $pdf->Image(base_url('assets/img/logo.jpg'),10,10,-300);
// mencetak string 
$pdf->Cell(200,7, $title ,0,1,'C');
// $pdf->Cell(280,7,$proposal['nama_proposal'],0,1,'C');
$pdf->SetFont('Arial','B',12);

//tabel
$pdf->Cell(10,10,'',0,1);
$pdf->SetFont('Arial','',12);

$pdf->Cell(30,10,'1. Judul SK',0,0,'L');
$pdf->Cell(30,10,':',0,0,'C');
$pdf->Cell(30,10, $sk_ormawa['nama_sk'],0,0,'L');
// $pdf->Cell(10,10,'',0,1); // spasi
// $pdf->Cell(30,10,'2. Waktu Pelaksanaan',0,0,'L');
// $pdf->Cell(30,10,':',0,0,'C');
// $pdf->Cell(30,10, $sk_ormawa['tanggal'],0,0,'L');

$pdf->Cell(10,14,'',0,1);

$pdf->Cell(10,14,'',0,1);
date_default_timezone_set("Asia/Jakarta");
$pdf->Cell(180,14,"Karawang,  " . date('d'). ' '.date('F').' '. date('Y') ,0,0, 'R');
$pdf->Cell(10,14,'',0,1);
// $pdf->Cell(250,14,"Admin" ,0,0, 'R');
$pdf->Image(base_url('assets/img/ttd3.jpg'),0,100,200,100);

$pdf->Output();
?>