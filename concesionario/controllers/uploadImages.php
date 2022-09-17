<?php
//Creamos la carpeta var si no existe
$path = "../var/vehiculos/";
if(!file_exists($path)){
    echo "Se creo el directorio";
    mkdir($path,0777,true);
}

$target_file = $path . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$especificationsErrors = "";

//Comprobar si el archivo ya existe
if (file_exists($target_file)) {
    $uploadOk = 0;
    $especificationsErrors .= "Ya existe el archivo, renombre el nuevo archivo, ";
}

//Comprobar peso
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
    $especificationsErrors .= "Archivo demasiado pesado, ";
}

// Permitir formatos
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){
    $uploadOk = 0;
    $especificationsErrors .= "No es formato JPG, PNG o JPEG.";
}

//Comprobar todas las validaciones
if($uploadOk == 1){
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //Subido correctamente
        echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
    }
    else{
        echo "Hubo un error al cargar el archivo";
        //Error de carga
    }
}
else{
    echo "No se ha validado correctamente el archivo por: ". $especificationsErrors;
}
?>