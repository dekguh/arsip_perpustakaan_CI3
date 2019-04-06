<?php
function alert($type,$msg){
    return "<div class='alert alert-$type'>$msg</div>";
}

function config_web(){
    $data = ["title_web" => "DekPerpus", "site" => "ganti ini", "secret" => "ganti ini"];
    return json_decode(json_encode($data));
}

function recaptcha($post){
    $config_web = config_web();
    $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$config_web->secret."&response=".$post);
    $url = json_decode($url);
    if($url->success == 1){
        return 1;
    }else{
        return 0;
    }
}

function peminjam_list_status(){
    return $data = [1 => "Meminjam", 2 => "Belum Mengembalikan", 3 => "Mengembalikan"];
}

function peminjam_status($status){
    $info = peminjam_list_status();
    if($status == 1){
        $stt = "<div class='badge badge-info'>".$info[$status]."</div>";
    }elseif($status == 2){
        $stt = "<div class='badge badge-warning'>".$info[$status]."</div>";
    }elseif($status == 3){
        $stt = "<div class='badge badge-success'>".$info[$status]."</div>";
    }

    return $stt;
}

function peminjam_select_status($select = ""){
    $info = peminjam_list_status();
    $temp = "";
    for($i=1;$i<=3;$i++){
        if($i == $select){
            $temp .= "<option value='$i' selected>".$info[$i]."</option>";
        }else{
            $temp .= "<option value='$i'>".$info[$i]."</option>";
        }
    }
    return $temp;
}
?>