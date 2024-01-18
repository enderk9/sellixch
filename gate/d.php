<?php


##API MADE BY ENDERFLY#
#JOIN NMB X RDXZ#

error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');

//===============[ PROXY ]===================//
if (file_exists(getcwd().('/cookie.txt'))){@unlink('cookie.txt');};
//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}


function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };
    
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";

$last4 = substr($cc, -4);
$anz = substr($cc, -4);
//================Get URL========//
$url_get = $_GET['sec'];
//================= [ CURL REQUESTS ] =================//
//===============REQ 3 =======================//
$url1 = 'http://api.proxy-checker.net/api/proxy-checker/';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1); // Chuyển sang phương thức GET
$headers = array();
$headers[] = 'Host: api.proxy-checker.net';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
$headers[] = 'accept: */*';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'proxy_list=88.92.92.33%3A5555');

$result2 = curl_exec($ch);
$three_d_secure_2_source = trim(strip_tags(getStr($result2,'"three_d_secure_2_source": "','",')));
//================[ REQ 3 ]===========//
$endTime = microtime(true);
$executionTime = $endTime - $startTime;
$timedone = round($executionTime, 2);
//===============[RESPONSES ]===================//

if(strpos($reult4, '"status": "succeeded"' )) {
    echo '<span style="background-color: white; color: blue; padding: 0px; display: inline-block;">STATUS:</span> <span style="color: green;">Payment Successful 🎉</span>  <br>URL: <span style="color: pink;">'.$url_get.'</span> <br>CC: <span style="text-decoration:none;color: pink;">'.$anz.'<br>Checker By: NMB</span><br>';
}
elseif(strpos($rsult4, "Your card has insufficient funds." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : CVV LIVE ✅ <br>STRIPE MSG : '.$msg.'<br>Bin Info: '.$scheme.' - '.$type.' - '.$brand.'<br>Bank: '.$bank.'<br>Country: '.$name.' '.$emoji.'<br>Proxy: '.$poxySocks4.'<br>Time Requests: '.$timedone.'s</span><br>';
}
elseif(strpos($revult3, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>STRIPE MSG : '.$msg.'<br>Time Requests: '.$timedone.'s</span><br>';
}
elseif(strpos($rsult1, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 1<br>Checker By: NMB</span><br>';
}
elseif(strpos($reslult2, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 2<br>Checker By: NMB</span><br>';
}
elseif(strpos($result3l, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 3<br>Checker By: NMB</span><br>';
}
elseif(strpos($result2l, "invalid_request_error" )) {
    echo '<span style="color: red;">DIE INVOICE</span> <br>URL: <span style="color: red;">'.$url_get.'</span> <br>RESULT : <span style="color: red;">EXP INVOICE</span> <br>Checker by: <span style="color: green;">NMB</span><br>';
}
elseif(strpos($result4l, "three_d_secure_2_source" )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : 3DS <br>Checker By: NMB</span><br>';
}
elseif(strpos($resul4, '"status": "requires_action"' )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : 3DS <br>Checker By: NMB</span><br>';
}
else {
    echo '#DIE API</span> CC:  '.$lista.'</span>  <br>Result: DIE API<br>REUSULT : '.$result2.'</span><br>';  
}


curl_close($ch);
ob_flush();
?>