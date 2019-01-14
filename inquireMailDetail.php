<?php
/**
 * Created by PhpStorm.
 * User: NHNEnt
 * Date: 2019-01-14
 * Time: 오후 9:29
 */

function get($url, $params){
    $options=[
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => ['Content-Type: application/json']
    ];
    $url = $url.'?'.http_build_query($params);
    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $result=curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    printf(($result));
}

function inquireMailDetail($app_key, $api_function, $requestId, $mailSeq){
    $url = 'https://api-mail.cloud.toast.com/email/v1.4/appKeys/'.$app_key.'/sender/'.$api_function;
    $params = array("requestId" => $requestId, "mailSeq" => $mailSeq);
    get($url, $params);
}

$app_key = "{APP_KEY}";
$inquireMailListApi = "mails";
$requestId = '2019010311175312940014';
$mailSeq = '0';

inquireMailDetail($app_key, $inquireMailListApi, $requestId, $mailSeq);

?>
