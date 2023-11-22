<?php session_start();
if ($_SERVER['HTTP_REFERER']!='https://accounts.google.com/') {
	header("HTTP/1.1 404 Not Found");
	include ('../404.html');
	exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"> 
<script>
<?php
$ini = parse_ini_file('../config.ini',true);
define('CONSUMER_KEY', '574496081057-c2535n3ugrob7o22rt55sqv34onb6u47.apps.googleusercontent.com');
define('CONSUMER_SECRET', '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');
define('CALLBACK_URL', 'https://localhost/Jinryu/login/redirect.php');

define('TOKEN_URL', 'https://accounts.google.com/o/oauth2/token');
define('INFO_URL', 'https://www.googleapis.com/oauth2/v1/userinfo');

$params = array(
	'code' => $_GET['code'],
	'grant_type' => 'authorization_code',
	'redirect_uri' => CALLBACK_URL,
	'client_id' => CONSUMER_KEY,
	'client_secret' => CONSUMER_SECRET,
);

$options = array('http' => array(
	'method' => 'POST',
	'content' => http_build_query($params)
));

$res = file_get_contents(TOKEN_URL, false, stream_context_create($options));

$token = json_decode($res, true);
if(isset($token['error'])){
?>
	window.opener.error('エラーが発生しました。');
<?php
} else {
	$access_token = $token['access_token'];

	$params = array('access_token' => $access_token);

	$res = file_get_contents(INFO_URL . '?' . http_build_query($params));

	$result = json_decode($res, true);

	try{
		$pdo = new PDO($ini['database']['dsn'],$ini['database']['username'],$ini['database']['password'],[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
		$stmt = $pdo->prepare("SELECT * FROM users WHERE id = '".$result['id']."'");
		$stmt->execute();
		foreach ($stmt as $row) {
			$db = $row;
			break;
		}
		if (isset($db)) {
			if ($result['email']!=$db['email']) {
				$stmt = $pdo->prepare("UPDATE users SET email = '".$result['email']."' WHERE id = '".$result['id']."'");
				$stmt->execute();
			}
		} else {
			$stmt = $pdo->prepare("SELECT * FROM users WHERE email = '".$result['email']."' AND id IS NULL");
			$stmt->execute();
			foreach ($stmt as $row) {
				$db = $row;
				break;
			}
			if (isset($db)) {
				$stmt = $pdo->prepare("UPDATE users SET id = '".$result['id']."' WHERE email = '".$result['email']."'");
				$stmt->execute();
			}
		}

		if (isset($db)) {
			$_SESSION["id"] = $result['id'];
			$_SESSION["name"] = $result['name'];
		} else {
?>
	window.opener.error('ログインが許可されていないユーザーです。');
<?php
		}
	} catch (PDOException $e)  {
?>
	window.opener.error('DBでエラーが発生しました。');
<?php
	}
}
?>
<?php
if (isset($_SESSION["id"]) and isset($db)) {
?>
    window.opener.redirect();
<?php } ?>
    window.close();
</script>
</head>
</html>