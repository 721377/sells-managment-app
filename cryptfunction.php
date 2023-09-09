<?php

function encryptId($id){
    $encrypt_method = "AES-256-CBC";
    $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR"; 
    $iv = "DFYTYUITYUIUYUGYIYT";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256',$iv) ,0, 16);

    $id = openssl_encrypt($id, $encrypt_method, $key, 0, $iv);
    $id = base64_encode($id);
    return $id;
}
function decryptId($id){
    $encrypt_method = "AES-256-CBC";
    $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR";
    $iv = "DFYTYUITYUIUYUGYIYT";
    $id = base64_decode($id);
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256',$iv) ,0, 16);

    $id = openssl_decrypt($id, $encrypt_method, $key, 0, $iv);
    return $id;
}
