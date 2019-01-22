<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>simplest php + mysql </title>
</head>
<body>
<h1>we love php! </h1>
<?php
#$vcap_services = json_decode(getenv('VCAP_SERVICES'));
#$service_name = 'cleardb'; // 次に選ぶサービス名
#$service = $vcap_services->$service_name;
#$credentials = $service[0]->credentials;
echo 'hostname:' , getenv("MYSQL_SERVICE_HOST");
print ("<br>");
echo 'port:' , $credentials->port;
print ("<br>");
echo 'name:' , getenv("MYSQL_DATABASE");
print ("<br>");
echo 'username:' , getenv("MYSQL_USER");
print ("<br>");
echo 'password:' , getenv("MYSQL_PASSWORD");
print ("<br>");
# $con = mysql_connect($credentials->hostname.":".$credentials->port, $credentials->username, $credentials->password);
#print($con);
#$res = mysqli_select_db("ad_b98e2c382d4e1fd");
#print($res);
//データベースの接続と選択
# echo 'start1';
$mysqli = new mysqli(getenv("MYSQL_SERVICE_HOST"), getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE") );
if ($mysqli->connect_error) {
    echo 'start1-err';
    error_log($mysqli->connect_error);
    exit;
}
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
//SQLを実行
# echo 'start2';
$sql = "show databases";
$res = $mysqli->query($sql);
echo $sql;
print ("<br>");
# echo $res;
# echo 'start3';
if (!$res) {
    error_log($mysqli->error);
    exit;
}
//結果の出力
while( $data = $res->fetch_array() ) {
	var_dump( $data );
}
//接続のクローズ
$mysqli->close();
?>

</body>
</html>
