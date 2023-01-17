<?php
$identificacion=$_POST['identificacion'];
$primer_nombre =$_POST['primer_nombre'];
$segundo_nombre=$_POST['segundo_nombre'];
$primer_apellido=$_POST['primer_apellido'];
$segundo_apellido=$_POST['segundo_apellido'];
$telefono=$_POST['telefono'];
$password=$_POST['password'];
$genero=$_POST['genero'];
$email=$_POST['email'];

if (!empty($identificacion)|| !empty($primer_nombre)||!empty($segundo_nombre)||!empty($primer_apellido)||!empty
($segundo_apellido)||!empty($telefono)||!empty($password)||!empty($genero)||!empty($email))
    
    $host="localhost";
    $dbusername="root";
    $password="";
    $dbname="c_vida";

 
    $conn = new mysqli($host,$dbusername,$password,$dbname);/*Abre una nueva conexion al servidor de Mysql*/
         if (mysqli_connect_error()) {
             die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
         }
    
            else{
             $SELECT="SELECT identificacion_usu from usuario where identificacion_usu=? limit 1";
              $INSERT="INSERT INTO usuario(`identificacion_usu`, `primer_nombre_usu`, `segundo_nombre_usu`, 
              `primer_apellido_usu`, `segundo_apellido_usu`, `numero_celular_usu`, `password`, `sexo`, `email`)
               value (?,?,?,?,?,?,?,?,?)";

                       $stmt=$conn->prepare($SELECT);/* Prepara una sentencia sql para su ejecucion  */
                       $stmt ->bind_param("i", $identificacion);/*Agrega variables a una sentencia perarada como parametros */
                       $stmt->execute();/*Ejecuta una consulta preparada  */
                       $stmt->bind_result($identificacion);/* Vincula variables a una sentencia preparada para el 
                                                             almacenamiento de resultados*/
                       $stmt->store_result();/*Transfiere un conjunto de resultados desde una sentencia preparada */
                       $rnum =$stmt->num_rows;/*Devuelve el número de filas de un conjunto de resultados.Si se usa 
                                                mysqli_stmt_store_result(), mysqli_stmt_num_rows() puede llamarse inmediatamente. */
           if ($rnum==0) {
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("issssisss",$identificacion,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,
            $telefono,$password,$genero,$email);
            $stmt->execute();
            echo "REGISTRO COMPLETADO. " ;
           }
           else {
           echo"Alguien registro ese numero";
           }
             $stmt->close();
             $conn->close();
              }
  
    die();



?>

