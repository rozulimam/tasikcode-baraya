<?php  
function tanggal($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $bulan   = bulan(substr($tgl, 5, 2));
    $tahun   = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function gender($gender)
{
    return ($gender == "L") ? "Laki-laki" : "Perempuan";
}

function bulan($bln) {
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function hari($day) {
    $days = array(
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jum'at",
        "Sabtu",
        "Minggu",
    );  
    $day = $day-1;
    return $days[$day];
}

function get_day($day) {
    $days = array(
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jum'at",
        "Sabtu",
        "Minggu",
    );   
    return $days[$day];
}

function date_db($date) {
    return date("Y-m-d",strtotime($date));
}

function date_id($date) {
    if($date){
        return date("d-m-Y",strtotime($date));
    }
    
}

function datetime_id($date) {
    if($date){
        return date("d-m-Y H:i",strtotime($date));
    }else{
        return '-';
    }
}

function set_date() {
    return date("Y/m/d");
}

function set_datetime() {
    return date("Y/m/d H:i:s");
}


function rupiah($angka) {
    $jadi = "Rp." . number_format($angka, 0, ',', '.');
    return $jadi;
}

function kilogram($gram) {
    return $gram/1000;
}

function count_ship_price($price,$weight){
    /*
      1. Menentukan batas berat toleransi biasnya 300 gram
      2. Rubah berat gram jadi kilogram
      3. Looping berdasarkan jumlah berat
      4. kemudian harga perklo di kalo jumlah berat
    */
    $top_weight=1.3;
    $weight=$weight/1000;
    for($x=1;$top_weight<$weight;$x++){
      $top_weight++;
    }
    $final_price = $x*$price;
    return $final_price;
}

function rupiah_angka($angka) {
    $jadi = number_format($angka, 0, ',', '.');
    return $jadi;
}

function clear_upper($str)
{
    return strtoupper(trim($str));
}

function selected($val1,$val2){
    if($val1 == $val2) return "selected=''";
}

function get_avatar($avatar){
    $dir     = "./upload/avatar/".$avatar;
    $default = base_url("upload/avatar/default.jpg");
    $origin  = base_url("upload/avatar/".$avatar);

    if(is_file($dir)){ 
        return $origin;
    }else{
        return $default;
    } 
} 

function get_upload_date($path)
{
    $last_update = "";
    $file_path   =  getcwd().'/'.$path;
    if(file_exists($file_path)){
        $last_update =  date ("YmdHis", filemtime($file_path));
    }
    return $last_update;
}

function trx_metode($metode)
{
    if($metode == "1"){
        return "Alamat sendiri";
    }else if($metode == "2"){
        return "Alamat lain (Dropship)";
    }else{
        return "Tanpa pengiriman";
    }
}
?>