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


if(isset($_POST['submit'])){

  $query = "TRUNCATE TABLE cov_data";
  $didTruncate = 0;

  if(!($didTruncate = mysqli_query($dbconn, $query))){
    die("Error!");
  }else{

  }

  if($didTruncate == 1){
    if($_FILES['file']['name']){
      $filename = explode('.', $_FILES['file']['name']);
      if($filename[1] == 'csv'){
        $handle = fopen($_FILES['file']['tmp_name'], 'r');
        $count = 0;
        $table_heads = array();
        while($data = fgetcsv($handle)){
          if($count < 1){
            array_push($table_heads, $data);
          }else{

            $insert_query = "INSERT INTO cov_data (FECHA_ACTUALIZACION, ID_REGISTRO, ORIGEN, SECTOR, ENTIDAD_UM, SEXO, ENTIDAD_NAC, ENTIDAD_RES, MUNICIPIO_RES, TIPO_PACIENTE, FECHA_INGRESO, FECHA_SINTOMAS, FECHA_DEF, INTUBADO, NEUMONIA, EDAD, NACIONALIDAD, EMBARAZO, HABLA_LENGUA_INDIG, DIABETES, EPOC, ASMA, INMUSUPR, HIPERTENSION, OTRA_COM, CARDIOVASCULAR, OBESIDAD, RENAL_CRONICA, TABAQUISMO, OTRO_CASO, RESULTADO, MIGRANTE, PAIS_NACIONALIDAD, PAIS_ORIGEN, UCI) VALUES ( '$data[0]', '$data[1]',  $data[2], $data[3], '$data[4]', $data[5], '$data[6]', '$data[7]', '$data[8]', $data[9], '$data[10]', '$data[11]', '$data[12]', $data[13], $data[14], $data[15], $data[16], $data[17], $data[18], $data[19], $data[10], $data[21], $data[22], $data[23], $data[24], $data[25], $data[26], $data[27], $data[28], $data[29], $data[30], $data[31], '$data[32]', '$data[33]', $data[34])";

            mysqli_query($dbconn, $insert_query);

          }
          $count++;
        }

        fclose($handle);

        print "Import done";
      }
    }
  }//END CHECK IF DID TRUNCATE TABLE

}

// $fileName = "200427COVID19MEXICO.csv";

//   $query = <<<eof
//     LOAD DATA INFILE '$fileName'
//      INTO TABLE cov_data
//      FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"'
//      LINES TERMINATED BY '\n'
// eof;
/*
FECHA_ACTUALIZACION,
ID_REGISTRO,
ORIGEN,
SECTOR,
ENTIDAD_UM,
SEXO,
ENTIDAD_NAC,
ENTIDAD_RES,
MUNICIPIO_RES,
TIPO_PACIENTE,
FECHA_INGRESO,
FECHA_SINTOMAS,
FECHA_DEF,
INTUBADO,
NEUMONIA,
EDAD,
NACIONALIDAD,
EMBARAZO,
HABLA_LENGUA_INDIG,
DIABETES,
EPOC,
ASMA,
INMUSUPR,
HIPERTENSION,
OTRA_COM,
CARDIOVASCULAR,
OBESIDAD,
RENAL_CRONICA,
TABAQUISMO,
OTRO_CASO,
RESULTADO,
MIGRANTE,
PAIS_NACIONALIDAD,
PAIS_ORIGEN,
UCI
*/


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload CSV to DB</title>
  </head>
  <body>
    <form class="" method="POST" enctype="multipart/form-data">
      <div class="" align="center">
        <p>Upload CSV: <input type="file" name="file" > </p>
        <p> <input type="submit" name="submit" value="Importar CSV"> </p>
      </div>
    </form>
  </body>
</html>
