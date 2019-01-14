<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:29
 */

function post($url, $postfields){

    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($postfields),
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function uploadFile($app_key, $fileName, $createUser, $imgSource){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key ."/attachfile/binaryUpload";
    $imgBinary = fread(fopen($imgSource, "r"), filesize($imgSource));
    $fileBody = base64_encode($imgBinary);
    $postfileds = array("fileName" => $fileName, "createUser" => $createUser, "fileBody" => $fileBody);
    post($url, $postfileds);
}

function sendMailWithFile($app_key, $api_function, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body, $attachFileIdList){
    $url = "https://api-mail.cloud.toast.com/email/v1.4/appKeys/".$app_key."/sender/".$api_function;
    $receiver1 = array ("receiveMailAddr" => $receiveMailAddr, "receiveName" => $receiveName, "receiveType" => $receiveType);
    $receiverList = array ($receiver1);
    $postfields = array ("senderAddress" => $senderAddress, "title" => $title, "body" => $body, "receiverList" => $receiverList, "attachFileIdList" => $attachFileIdList);
    post($url, $postfields);
}

$app_key = "{APP_KEY}";
$standardMailApi = "mail";
$receiveMailAddr = 'hankyul.lee@nhnent.com';
$receiveName = 'lee';
$receiveType = 'MRT0';
$senderAddress = 'woodikol1258@gmail.com';
$title = 'title';
$body = 'body';

$imgSource = "123.jpg";
$fileName = 'fileName';
$createUser = 'lee';
$attachFileIdList = array(287);

sendMailWithFile($app_key, $standardMailApi, $receiveMailAddr, $receiveName, $receiveType, $senderAddress, $title, $body, $attachFileIdList);

?>