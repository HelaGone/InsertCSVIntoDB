<?php

ini_set('display_errors', 'On');
ini_set('memory_limit', '512M');
error_reporting(E_ALL | E_STRICT); //DECLARA DEBUG, COMENTAR ESTA LINEA CUANDO TERMINE DE HACER DEBUG

//DEVELOPMENT
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', 'helagone-pass');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_NAME', 'tests_db');


// PRODUCTION
// DEFINE('DB_USER', 'dbdart_master');
// DEFINE('DB_PSWD', 'fc8u&EAk%or1UVHYmf*IH');
// DEFINE('DB_HOST', 'localhost');
// DEFINE('DB_NAME', 'dbdart_ntcoronamapa');

$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
mysqli_set_charset($dbconn,'utf8');
if(!$dbconn){
  die(' ERROR EN LA CONEXIÓN A DB');
}


  $fileName = "200427COVID19MEXICO.csv";

  $query = <<<eof
    LOAD DATA INFILE '$fileName'
     INTO TABLE cov_data
     FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
     LINES TERMINATED BY '\n'
eof;

if(!($result = mysqli_query($dbconn, $query))){
    die("Error!");
  }else{

    if(mysqli_num_rows($result) == 0){
      echo "No Rows Returned";
    }else{
      $result = mysqli_fetch_all($result, MYSQLI_ASSOC);

      foreach ($result as $key => $value):
        print_r($value);
      endforeach;

    }
  }


?>
