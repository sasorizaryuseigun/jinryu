<?php
session_start();
$path='../';
$to_path='/login/';
if (isset($_GET['logout'])) {
    $_SESSION = array();
}

define('CONSUMER_KEY', '574496081057-c2535n3ugrob7o22rt55sqv34onb6u47.apps.googleusercontent.com');
define('CALLBACK_URL', 'https://localhost/Jinryu/login/redirect.php');
define('AUTH_URL', 'https://accounts.google.com/o/oauth2/auth');

$params = array(
	'client_id' => CONSUMER_KEY,
	'redirect_uri' => CALLBACK_URL,
	'scope' => 'https://www.googleapis.com/auth/userinfo.profile email',
	'response_type' => 'code',
);

$login_url=AUTH_URL.'?'.http_build_query($params);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"> 
    <title>ログイン</title>
    <link rel="icon" href="<?php echo $path; ?>icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
<?php include($path.'include/header.css'); ?>
        body{
            margin:0;
            font-family:initial;
        }
        .middle > *{
            vertical-align: middle;
        }
        .main > *{
            margin:20px;
        }
        .google-button{
            margin-top:0;
            margin-bottom:0;
        }
    </style>
</head>
<body>
<?php include($path.'include/header.php'); ?>
    <div class='main'>
        <h2>ログイン</h2>
        <button id="button" type="button" class="btn btn-secondary middle google-button" onclick="new_window_open();">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="2.5ex" height="2.5ex" viewBox="-10 -10 68 68" class="abcRioButtonSvg"><circle cx="24" cy="24" r="34" fill="#ffffff" /><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
            <span>Googleでログイン<span>
        </button>
    </div>
<!-- <div class="g-signin2" data-onsuccess="onSignIn"></div>
<div onclick="new_window_open();"><div style="height:36px;width:120px;" class="abcRioButton abcRioButtonLightBlue"><div class="abcRioButtonContentWrapper"><div class="abcRioButtonIcon" style="padding:8px"><div style="width:18px;height:18px;" class="abcRioButtonSvgImageWithFallback abcRioButtonIconImage abcRioButtonIconImage18"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg></div></div><span style="font-size:13px;line-height:34px;" class="abcRioButtonContents"><span id="not_signed_inwu39gnlmroxu">ログイン</span></span></div></div></div> -->
<script>
const button = document.getElementById('button');
const message=document.createElement('p');

function new_window_open(){
	let newwin = window.open('<?php echo $login_url ?>',null,"width=600,height=600");
}
<?php
if (isset($_GET['logout'])) {
?>
message.textContent='ログアウトされました。';
button.before(message);
<?php
}
if (isset($_GET['next'])) {
?>
message.textContent='ログインが必要なページです。';
button.before(message);
<?php
    $url='..'.$_GET['next'];
} else {
    $url='../';
}
$n=0;
foreach ($_GET as $key => $get) {
    if ($key!='next' and $key!='logout') {
        if ($n==0) {
            $url= $url.'?'.$key.'='.$get;
        } else {
            $url= $url.'&'.$key.'='.$get;
        }
        $n=$n+1;
    }
}
?>

function redirect() {
    location.assign('<?php echo $url; ?>');
}

function error(error_message) {
    message.textContent=error_message;
    message.classList.add('text-danger');
    button.before(message);
}
</script>
</body>
</body> 
</html>