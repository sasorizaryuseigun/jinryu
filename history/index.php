<?php
session_start();
$path='../';
$to_path='/history/';
require($path.'include/logincheck.php');
$ini = parse_ini_file('../config.ini',true);
$pdo = new PDO($ini['database']['dsn'],$ini['database']['username'],$ini['database']['password'],[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
$stmt = $pdo->prepare("SELECT datetime,latitude,longitude,radius,number FROM history WHERE id = '".$_SESSION['id']."'");
$stmt->execute();
foreach ($stmt as $row) { 	
  $db[]=[
    'datetime'=>$row['datetime'],
    'latitude'=>preg_replace("/(?:\.|)0+$/", "",$row['latitude']),
    'longitude'=>preg_replace("/(?:\.|)0+$/", "",$row['longitude']),
    'radius'=>$row['radius'],
    'number'=>$row['number'],
    'link'=>'<a href="https://localhost/jinryu/?lat='.preg_replace("/(?:\.|)0+$/", "",$row['latitude']).'&lon='.preg_replace("/(?:\.|)0+$/", "",$row['longitude']).'&rad='.$row['radius'].'&no='.$row['number'].'" target="_blank" rel="noopener noreferrer">結果を表示</a>'
  ];
}
?>
<!doctype html>
<html lang="js">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
    <title>履歴</title>
    <link rel="icon" href="<?php echo $path; ?>icon.ico">
    <style>
<?php include($path.'include/header.css'); ?>
    body{
      margin:0;
      font-family:initial;
    }
    .main > *{
      margin:20px;
      max-width:1200px;
    }
    .page-link {
      color: #6C757D;
      text-decoration: none;
      background-color: #fff;
      border: 1px solid #dee2e6;
    }
    .page-link:hover {
      color: #6C757D;
      background-color: #e9ecef;
      border-color: #dee2e6;
    }
    .page-link:focus {
      color: #6C757D;
      background-color: #e9ecef;
      box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
    }
    .page-item.active .page-link {
      color: #fff;
      background-color: #6C757D;
      border-color: #6C757D;
    }
    .page-item.disabled .page-link {
      color: #6c757d;
      background-color: #fff;
      border-color: #dee2e6;
    }
    </style>
  </head>
  <body>
  <?php include($path.'include/header.php'); ?>
  <div class='main'>
    <h2>実行履歴</h2>
    <table id="data-bind-json-sample" class="table table-striped dt-responsive nowrap" style="width:100%">
   <thead>
      <tr>
        <th>日時</th>
        <th>緯度</th>
        <th>経度</th>
        <th>検索半径</th>
        <th>No.</th>
        <th>リンク</th>
      </tr>
   </thead>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js",integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=",crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
    <script>

    var jsonData = <?php echo json_encode($db); ?>;

    $(function() {
    $("#data-bind-json-sample").DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
        },
        responsive: true,
        order: [ [ 0, "desc" ] ],
        data: jsonData,
        columns: [
          { data: 'datetime' },
          { data: 'latitude' },
          { data: 'longitude' },
          { data: 'radius' },
          { data: 'number' },
          { data: 'link' }
        ],
    });
    })
    </script>
</body>
</html>