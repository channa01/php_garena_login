<?php
//resource by https://github.com/puarudz/CheckLoginGarena
// <!-- Modify code By mr_temm discord mr_temm#1599 -->
require('function.php');
$keycaps = md5(microtime_float());
file_put_contents("captcha/captcha.png",curl("https://gop.captcha.garena.com/image?key=".$keycaps));

if(isset($_POST['login'])){

    $passmd5 = md5(urldecode($_POST['password']));
    $username = $_POST['username'];
    $captcha = $_POST['captcha'];
    $captcha_key = $_POST['captcha_key'];

    runne:
    $get = json_decode(curl("https://sso.garena.com/api/prelogin?account=".$username."&captcha_key=".$captcha_key."&captcha=".$captcha."&format=json&id=".microtime_float()."&app_id=10100"),true);
    if(@$get['error'] == "error_captcha"){
        goto runne;
    } 
    if(@$get['error'] == "error_require_captcha"){
        goto runne;
    }

    @$pass= EnCode($passmd5,hash('sha256',hash('sha256',$passmd5.$get['v1']).$get['v2']));

    $url= json_decode(curl("https://sso.garena.com/api/login?account=".$username."&password=".$pass."&format=json&id=".microtime_float()."&app_id=10100"),true);
        if(empty($url['uid'])) {
            $showinfo['error'] = "Login garena fail!!"; //เข้าสู่ระบบไม่สำเร็จ
        }else{
            
            $session_key = "https://account.garena.com/api/account/init?session_key=".$url['session_key'];

            $user_info = json_decode(curl($session_key),true); 
            //$user_info = json_decode(curl("http://gameprofile.garenanow.com/api/game_profile/?uid=".$url['uid']."&region=th"),true);
            if($user_info['user_info']['email_v'] == 0){
                $showinfo['verimail'] = "Login garena success!! not verified email"; //เข้าระบบผ่าน แต่ยันไม่ได้ ยืนยันเมล
            }else{
                $showinfo['verimail'] = "Login garena success!! verified email"; //เข้าสู่ระบบ และยืนยันเมลแล้ว
            }
            if(!empty($user_info['user_info']['avatar'])) $showinfo['url_avatar'] = $user_info['user_info']['avatar'];
            if(!empty($user_info['user_info']['email'])) $showinfo['email'] = $user_info['user_info']['email']; 
            if(!empty($user_info['user_info']['username'])) $showinfo['username'] = $user_info['user_info']['username']; 
            if(!empty($user_info['user_info']['mobile_no'])) $showinfo['mobile_no'] = $user_info['user_info']['country_code'].$user_info['user_info']['mobile_no'];
             


            // "username": "your_username",
            // "status": 1,
            // "acc_country": "TH",
            // "uid": 10101010,
            // "level": 1,
            // "mobile_binding_status": 0,
            // "password_s": 2,
            // "suspicious": false,
            // "signature": "",
            // "email_verify_available": true,
            // "shell": 0,
            // "email_v": 1,
            // "mobile_no": "****6000",
            // "country_code": "66",
            // "two_step_verify_enable": 1,
            // "authenticator_enable": 0,
            // "fb_account": null,
            // "nickname": "",
            // "email": "test****@gmail.com",
            // "avatar": "https://cdngarenanow-a.akamaihd.net/gxx/resource/avatar/0.jpg"

        }
        echo json_encode($showinfo);
}
?>