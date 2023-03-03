<?php
error_reporting(0);
function delTree($dir) {
  $files = array_diff(scandir($dir), array('.', '..'));
  foreach ($files as $file) {
    (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
  }
  return rmdir($dir);
}
function mailru($email){
$ch = curl_init();
curl_setopt_array($ch,array(
CURLOPT_URL => 'https://auth.mail.ru/api/v1/pushauth/info?login='.urlencode($email).'&_=1580336451166',
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
'Host: recostream.go.mail.ru',
'Connection: keep-alive',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
'Accept: */*',
'Origin: https://mail.ru',
'Sec-Fetch-Site: same-site',
'Sec-Fetch-Mode: cors',
'Referer: https://mail.ru/',
'Accept-Encoding: gzip, deflate, br',
'Accept-Language: en-US,en;q=0.9,ar;q=0.8'),
CURLOPT_ENCODING => "gzip"
));
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result,true);
$exists = $result['body']['exists'];
if($exists == '1' or $exists == 'true'){
return 'false';
} else {
return 'true';
}
}
function gmail($email){
$ch = curl_init();
curl_setopt_array($ch,array(
CURLOPT_POST => 1,
CURLOPT_URL => 'https://accounts.google.com/InputValidator?resource=SignUp&service=mail',
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
'Content-Type: application/json; charset=utf-8',
'Host: accounts.google.com',
'Expect: 100-continue'),
CURLOPT_POSTFIELDS => '{"input01":{"Input":"GmailAddress","GmailAddress":"'.$email.'","FirstName":"khafeer","LastName":"zedtool"},"Locale":"en"}',
CURLOPT_ENCODING => "gzip"
));
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result,true);
$valid = $result['input01']['Valid'];
if($valid == 'true'){
return 'true';
} else {
return 'false';
}
}
function hotmail($email){
$ch = curl_init();
curl_setopt_array($ch,array(
CURLOPT_URL => 'https://login.live.com/',
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HEADER => true,
));
$newurl = curl_exec($ch);
curl_close($ch);
preg_match("/\:'https\:\/\/login.live.com\/GetCredentialType(.*)',/", $newurl,$m);
$url = explode("',", $m[0])[0];
$url = str_replace(':\'', '',$url);
$uaid = explode('uaid=', $url)[1];
$ch = curl_init();
curl_setopt_array($ch,array(
CURLOPT_POST => 1,
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => array(
'Connection: keep-alive',
'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="96"',
'sec-ch-ua-mobile: ?1',
'User-Agent: Mozilla/5.0 (Linux; Android 11; SM-A217F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.46 Mobile Safari/537.36',
'client-request-id: 06387b1465a14dd4b7c72acaffef6d19',
'Content-type: application/json; charset=UTF-8',
'hpgid: 38',
'Accept: application/json',
'hpgact: 0',
'sec-ch-ua-platform: "Android"',
'Origin: https://login.live.com',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-Mode: cors',
'Sec-Fetch-Dest: empty',
'Referer: https://login.live.com/',
'Accept-Language: ar-AE,ar;q=0.9,en-US;q=0.8,en;q=0.7,de-DE;q=0.6,de;q=0.5',
'Cookie: MSFPC=GUID=f0366ab7944549f6adcd5bb6d542a8c0&HASH=f036&LV=202111&V=4&LU=1638310818070; mkt=ar-AE; MUID=20B02306D54D6B170C8433F8D4C76A80; IgnoreCAW=1; SDIDC=CRY1nmirpLyfx7\u0021wDHBfayY8PWSRHjeXYxfCKsqXSfpPgJYL3w99iKHLXfsqHTlAAPYkLazDLGnfbDy*4LQG9DocEYVq8A8GaobChmgvgfgFITuRmyCDdR8OnIADhywnlB*9eXYFLveFNVXLjSkiPeOXRziz6ZDaRFTquCB3RxQSwDol09Vili7WdIc2EIgzZi3gLKyIMIXidEyrt2BJoBGiqEgfP8C8JGyKyDBP2vY3; logonLatency=LGN01=637785477782744123; uaid=06387b1465a14dd4b7c72acaffef6d19; MSPRequ=id=292841&lt=1642950980&co=1; MSCC=159.223.146.202-US; OParams=11O.DWvzEcPdsd6cnqGP3DFw1K8PwsVuKQDCUeyAPLaJvw4t6CYyP5Y8\u00214lyC4UxR\u0021GDAIQ1rmaTw9BqqiwTrO7e29wItpZgT5awQWdpbqKhzP7\u0021ux8WDbdjQvLik\u0021QseS6vQM2xErh3CuGpoTvGTM3BifYown2ac0uA5vQ3cUijOfYRL5HsPuQIf08rozuROPtY*jikMDh0SOTMVQpJ4wrGYG1LilCZsVcAJUt8V3ORd\u0021WzAoUmNxMmkUashSwBsT8ecMhq8r5o1*goWvaFAxanyDkmJUbvU8U1OjeYdqdehnqALpo0Y6UKS0WFezWn9Chd88qHslzbu1aTlmOVe7ftqnhxvmcSINDCQiOoMa6kVHvStfPpO7OSTV\u0021FFGS1k9oWLFnYaH2iqvrEmbs7g00tnuxQuWMAgkI5*BOFjkQ2jBEgsSEJiYKWxkpPPW1BJziqS0s3WHhuFXoEmYlxSGhLRrnrmhnpI7EvTqrtEq1VWlzv; MSPOK=$uuid-62867c1f-3041-4446-b100-9de240a21f65'
),
CURLOPT_POSTFIELDS => '{"username":"'.$email.'","uaid":"'.$uaid.'","isOtherIdpSupported":true,"checkPhones":false,"isRemoteNGCSupported":true,"isCookieBannerShown":false,"isFidoSupported":false,"forceotclogin":false,"otclogindisallowed":false,"isExternalFederationDisallowed":false,"isRemoteConnectSupported":false,"federationFlags":3,"isSignup":false,"flowToken":"DZ2awP0yZDl8K\u0021UPsq2*xMOoUnRyWtqi6O5nk6hFRPPfWNJa0ZgDnG\u0021cq8\u0021kjfVTiYLDwKDbhelopWtz*8WgIBj6cMKyuKByfsJV1SnARwZ*NX4pnHhvWwbLEijiQp5RMecDj6k*NX2YCYjagHoeMUGG*lfUFTnfwUNz2t4NP62FGajxILttREJL9f1j6vfsSW1D3ldTDppkZqtAgJ*EyuNGcpKCr8O*fGnqwpkNLqFYXBzyFvTpBMxlV24XRevg8GcWKMRchmqvodEGTqtShUs$"}',
CURLOPT_ENCODING => "gzip"
));
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
$valid = $result->IfExistsResult;
if($valid == '1'){
return 'true';
} else {
return 'false';
}
}
function yahoo($email){
@mkdir("Info");
$c = curl_init("https://login.yahoo.com/"); 
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36"); 
curl_setopt($c, CURLOPT_REFERER, 'https://www.google.com'); 
curl_setopt($c, CURLOPT_ENCODING, 'gzip, deflate, br');  
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($c, CURLOPT_HEADER, true); 
curl_setopt($c, CURLOPT_COOKIEJAR, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_COOKIEFILE, "Info/cookie.txt"); 
$response = curl_exec($c); 
$httpcode = curl_getinfo($c); 
$header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE)); 
$body = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE)); 
preg_match_all('#name="crumb" value="(.*?)" />#', $response, $crumb); 
preg_match_all('#name="acrumb" value="(.*?)" />#', $response, $acrumb); 
preg_match_all('#name="config" value="(.*?)" />#', $response, $config); 
preg_match_all('#name="sessionIndex" value="(.*?)" />#', $response, $sesindex); 
$data['status'] = "ok"; 
$data['crumb'] = isset($crumb[1][0]) ? $crumb[1][0] : ""; 
$data['acrumb'] = $acrumb[1][0]; 
$data['config'] = isset($config[1][0]) ? $config[1][0] : ""; 
$data['sesindex'] = $sesindex[1][0]; 
$crumb = trim($data['crumb']); 
$acrumb = trim($data['acrumb']); 
$config = trim($data['config']); 
$sesindex = trim($data['sesindex']); 
$header = array(); 
$header[] = "Host: login.yahoo.com"; 
$header[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:56.0) Gecko/20100101 Firefox/56.0"; 
$header[] = "Accept: */*"; 
$header[] = "Accept-Language: en-US,en;q=0.5"; 
$header[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8"; 
$header[] = "X-Requested-With: XMLHttpRequest"; 
$header[] = "Referer: https://login.yahoo.com/"; 
$header[] = "Connection: keep-alive"; 
$data = "acrumb=$acrumb&sessionIndex=$sesindex&username=".urlencode($email)."&passwd=&signin=Next"; 
$c = curl_init("https://login.yahoo.com/"); 
curl_setopt($c, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36"); 
curl_setopt($c, CURLOPT_REFERER, 'https://login.yahoo.com/'); 
curl_setopt($c, CURLOPT_ENCODING, 'gzip, deflate, br');  
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($c, CURLOPT_HTTPHEADER, $header); 
curl_setopt($c, CURLOPT_COOKIEJAR, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_COOKIEFILE, "Info/cookie.txt"); 
curl_setopt($c, CURLOPT_POSTFIELDS, $data); 
curl_setopt($c, CURLOPT_POST, 1); 
$b = curl_exec($c);
curl_close($c);
if(strpos($b,"messages.INVALID_USERNAME")){
return 'true';
}else{
return 'false';
}
}
function tiktok($email){
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => 'https://api2-t2.musical.ly/aweme/v1/passport/find-password-via-email/?version_code=7.6.0&language=ar&app_name=musical_ly&vid=43647C38-9344-40A3-AD8E-29F6C7B987E4&app_version=7.6.0&is_my_cn=0&channel=App%2520Store&mcc_mnc=&device_id=6999590732555060741&tz_offset=10800&account_region=&sys_region=SA&aid=1233&screen_width=1242&openudid=a0594f8115e0a1a51e1a31490aeef9afc2409ff4&os_api=18&ac=WIFI&os_version=12.5.4&app_language=ar&tz_name=Asia/Riyadh&device_platform=iphone&build_number=76001&iid=7021194671750481669&device_type=iPhone7,1&idfa=20DB6089-D1C6-49EF-8943-9C310C8F1B5D&mas=002ed4fcfe1207217efade4142d0b05e0c845e118f07206205d6a8&as=a11664d78a2e110bd08018&ts=16347494182',
CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'email='.$email,
  CURLOPT_HTTPHEADER => array(
    'reqHostreq:  reqapi2-t2.musical.lyreq,',
    'reqAcceptreq:  req*/*req,',
    'reqContent-Typereq:  reqapplication/x-www-form-urlencodedreq,',
    'reqUser-Agentreq:  reqMusically/7.6.0 (iPhone; iOS 12.5.4; Scale/3.00)req,',
    'reqAccept-Languagereq:  reqar-SA;q=1req,',
    'reqContent-Lengthreq:  req25req,',
    'reqConnectionreq:  reqclosereq',
    'Content-Type: application/x-www-form-urlencoded',
    'Cookie: odin_tt=801cb69ce874fbd572fbebfcecd8ad00035280684f2afee746b526cc18466b9a6e2d05db44634b02861315c4a47060e3ce3f2979c113f55c61554986066384f8f2ab67e717d1184a64e8ad4448654a77'
  ),
));
$result = curl_exec($ch);
curl_close($ch);
if(strpos($result, "Bind device by email failed") !== false){
return 'false';
} else {
return 'true';
}
}
/*
function GUID(){
    if (function_exists('com_create_guid') === true){
        return trim(com_create_guid(), '{}');
    }
    }

*/

class EzTGException extends Exception
{
}
function bot($method,$datas=[]){
    global $token;
$url = "https://api.telegram.org/bot".$token."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}


class EzTG
{
    private $settings;
    private $offset;
    private $json_payload;
    public function __construct($settings, $base = false)
    {
        $this->settings = array_merge(array(
      'endpoint' => 'https://api.telegram.org',
      'token' => '1234:abcd',
      'callback' => function ($update, $EzTG) {
          echo 'no callback' . PHP_EOL;
      },
      'objects' => true,
      'allow_only_telegram' => true,
      'throw_telegram_errors' => true,
      'magic_json_payload' => false
    ), $settings);
        if ($base !== false) {
            return true;
        }
        if (!is_callable($this->settings['callback'])) {
            $this->error('Invalid callback.', true);
        }
        if (php_sapi_name() === 'cli') {
            $this->settings['magic_json_payload'] = false;
            $this->offset = -1;
            $this->get_updates();
        } else {
            if ($this->settings['allow_only_telegram'] === true and $this->is_telegram() === false) {
                http_response_code(403);
                echo '403 - You are not Telegram,.,.';
                return 'Not Telegram';
            }
            if ($this->settings['magic_json_payload'] === true) {
                ob_start();
                $this->json_payload = false;
                register_shutdown_function(array($this, 'send_json_payload'));
            }
            if ($this->settings['objects'] === true) {
                $this->processUpdate(json_decode(file_get_contents('php://input')));
            } else {
                $this->processUpdate(json_decode(file_get_contents('php://input'), true));
            }
        }
    }
    private function is_telegram()
    {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) { //preferisco non usare x-forwarded-for xk si può spoof
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if (($ip >= '149.154.160.0' && $ip <= '149.154.175.255') || ($ip >= '91.108.4.0' && $ip <= '91.108.7.255')) { //gram'''s ip : https://core.telegram.org/bots/webhooks
            return true;
        } else {
            return false;
        }
    }
    private function get_updates()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->settings['endpoint'] . '/bot' . $this->settings['token'] . '/getUpdates');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        while (true) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, 'offset=' . $this->offset . '&timeout=10');
            if ($this->settings['objects'] === true) {
                $result = json_decode(curl_exec($ch));
                if (isset($result->ok) and $result->ok === false) {
                    $this->error($result->description, false);
                } elseif (isset($result->result)) {
                    foreach ($result->result as $update) {
                        if (isset($update->update_id)) {
                            $this->offset = $update->update_id + 1;
                        }
                        $this->processUpdate($update);
                    }
                }
            } else {
                $result = json_decode(curl_exec($ch), true);
                if (isset($result['ok']) and $result['ok'] === false) {
                    $this->error($result['description'], false);
                } elseif (isset($result['result'])) {
                    foreach ($result['result'] as $update) {
                        if (isset($update['update_id'])) {
                            $this->offset = $update['update_id'] + 1;
                        }
                        $this->processUpdate($update);
                    }
                }
            }
        }
    }
    public function processUpdate($update)
    {
        $this->settings['callback']($update, $this);
    }
    protected function error($e, $throw = 'default')
    {
        if ($throw === 'default') {
            $throw = $this->settings['throw_telegram_errors'];
        }
        if ($throw === true) {
            throw new EzTGException($e);
        } else {
            echo 'Telegram error: ' . $e . PHP_EOL;
            return array(
        'ok' => false,
        'description' => $e
      );
        }
    }
    public function newKeyboard($type = 'keyboard', $rkm = array('resize_keyboard' => true, 'keyboard' => array()))
    {
        return new EzTGKeyboard($type, $rkm);
    }
    public function __call($name, $arguments)
    {
        if (!isset($arguments[0])) {
            $arguments[0] = array();
        }
        if (!isset($arguments[1])) {
            $arguments[1] = true;
        }
        if ($this->settings['magic_json_payload'] === true and $arguments[1] === true) {
            if ($this->json_payload === false) {
                $arguments[0]['method'] = $name;
                $this->json_payload = $arguments[0];
                return 'json_payloaded'; //xd
            } elseif (is_array($this->json_payload)) {
                $old_payload = $this->json_payload;
                $arguments[0]['method'] = $name;
                $this->json_payload = $arguments[0];
                $name = $old_payload['method'];
                $arguments[0] = $old_payload;
                unset($arguments[0]['method']);
                unset($old_payload);
            }
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->settings['endpoint'] . '/bot' . $this->settings['token'] . '/' . urlencode($name));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($arguments[0]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($this->settings['objects'] === true) {
            $result = json_decode(curl_exec($ch));
        } else {
            $result = json_decode(curl_exec($ch), true);
        }
        curl_close($ch);
        if ($this->settings['objects'] === true) {
            if (isset($result->ok) and $result->ok === false) {
                return $this->error($result->description);
            }
            if (isset($result->result)) {
                return $result->result;
            }
        } else {
            if (isset($result['ok']) and $result['ok'] === false) {
                return $this->error($result['description']);
            }
            if (isset($result['result'])) {
                return $result['result'];
            }
        }
        return $this->error('Unknown error', false);
    }
    public function send_json_payload()
    {
        if (is_array($this->json_payload)) {
            ob_end_clean();
            echo json_encode($this->json_payload);
            header('Content-Type: application/json');
            ob_end_flush();
            return true;
        }
    }
}
class EzTGKeyboard
{
    public function __construct($type = 'keyboard', $rkm = array('resize_keyboard' => true, 'keyboard' => array()))
    {
        $this->line = 0;
        $this->type = $type;
        if ($type === 'inline') {
            $this->keyboard = array(
        'inline_keyboard' => array()
      );
        } else {
            $this->keyboard = $rkm;
        }
        return $this;
    }
    public function add($text, $callback_data = null, $type = 'auto')
    {
        if ($this->type === 'inline') {
            if ($callback_data === null) {
                $callback_data = trim($text);
            }
            if (!isset($this->keyboard['inline_keyboard'][$this->line])) {
                $this->keyboard['inline_keyboard'][$this->line] = array();
            }
            if ($type === 'auto') {
                if (filter_var($callback_data, FILTER_VALIDATE_URL)) {
                    $type = 'url';
                } else {
                    $type = 'callback_data';
                }
            }
            array_push($this->keyboard['inline_keyboard'][$this->line], array(
        'text' => $text,
        $type => $callback_data
      ));
        } else {
            if (!isset($this->keyboard['keyboard'][$this->line])) {
                $this->keyboard['keyboard'][$this->line] = array();
            }
            array_push($this->keyboard['keyboard'][$this->line], $text);
        }
        return $this;
    }
    public function newline()
    {
        $this->line++;
        return $this;
    }
    public function done()
    {
        if ($this->type === 'remove') {
            return '{"remove_keyboard": true}';
        } else {
            return json_encode($this->keyboard);
        }
    }
}