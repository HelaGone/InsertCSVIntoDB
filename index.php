<?php

ini_set('display_errors', 'On');
ini_set('memory_limit', '512M');
error_reporting(E_ALL | E_STRICT); //DECLARA DEBUG, COMENTAR ESTA LINEA CUANDO TERMINE DE HACER DEBUG

//DEVELOPMENT
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', 'helagone-pass');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_NAME', 'tests_db');


$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PSWD, DB_NAME);
mysqli_set_charset($dbconn,'utf8');
if(!$dbconn){
  die(' ERROR EN LA CONEXIÓN A DB');
}


  $fileName = "200427COVID19MEXICO.csv";

//   $query = <<<eof
//     LOAD DATA INFILE '$fileName'
//      INTO TABLE cov_data
//      FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
//      LINES TERMINATED BY '\n'
// eof;

/*FECHA_ACTUALIZACION, ID_REGISTRO, ORIGEN, SECTOR, ENTIDAD_UM, SEXO, ENTIDAD_NAC, ENTIDAD_RES, MUNICIPIO_RES, TIPO_PACIENTE, FECHA_INGRESO, FECHA_SINTOMAS, FECHA_DEF, INTUBADO, NEUMONIA, EDAD, NACIONALIDAD, EMBARAZO, HABLA_LENGUA_INDIG, DIABETES, EPOC, ASMA, INMUSUPR, HIPERTENSION, OTRA_COM, CARDIOVASCULAR, OBESIDAD, RENAL_CRONICA, TABAQUISMO, OTRO_CASO, RESULTADO, MIGRANTE, PAIS_NACIONALIDAD, PAIS_ORIGEN, UCI*/

$query = "TRUNCATE TABLE cov_data";

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
