<?php    
		
function uploadFile() {
	$namafile = $_FILES['berkas']['name'];
	$ukuranFile = $_FILES['berkas']['size'];
	$error = $_FILES['berkas']['error'];
	$tmpName = $_FILES['berkas']['tmp_name'];
	
	//cek apakah tidak ada berkas yang diupload
	if ($error === 4){
		echo "<script> alert('Masukkan berkas!')</script>";
		return false;
	}
	
	// cek apakah yang diupload adalah berkas
	$ekstensiberkasValid = ['pdf','doc','docx'];
	$ekstensiberkas = explode('.',$namafile);
	$ekstensiberkas = strtolower(end($ekstensiberkas));
	if(!in_array($ekstensiberkas,$ekstensiberkasValid)){
		echo"<script>alert('Yang Anda upload bukan berkas !!!')</script>";
	}
	
	// cek jika ukurannya terlalu besar
	if($ukuranFile > 999999999){
		echo"<script>alert('Ukuran berkas Terlalu Besar')</script>";
	}
	
	// lolos pengecekan, berkas siap diupload
	// generate nama berkas
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensiberkas;
	// move_uploaded_file($tmpName,'img/'. $namafilebaru);
	move_uploaded_file($tmpName,'././file_proposal/'. $namafilebaru);
	return $namafilebaru;
	
}