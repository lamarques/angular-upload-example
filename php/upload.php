<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

$url = 'http://localhost:8080/public/upload/';

$data = new DateTime();
$filename = md5($_FILES['file']['name'] . $data->format('dmYHis'));
$path_parts = pathinfo($_FILES["file"]["name"]);
$extension = $path_parts['extension'];
$filename .= '.' . $extension;
try {
    move_uploaded_file($filename, __DIR__ .'/public/upload/'.$filename);
    echo $url.$filename;
} catch (Exception $e) {
    echo $e->getMessage();
}

