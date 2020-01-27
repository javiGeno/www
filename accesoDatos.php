<?php
    
    //Creamos la conexión
    
    $conexion = mysqli_connect("192.168.254.2", "usuario", "1234", "db") 
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    
    //generamos la consulta
    $sql = "select * from EQUIPOS";
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if(!$result = mysqli_query($conexion, $sql)) die();

    $equipos =[]; //creamos un array

    while($row = mysqli_fetch_array($result)) 
    { 
        $RS=$row['RAZON_SOC'];
        $estadio=$row['ESTADIO'];
        $escudo=$row['ESCUDO'];
        $anio=$row['AÑO_FUNDAC'];
        
        

        $equipos[] = array('razon'=> $RS, 'estadio'=> $estadio, 'escudo'=> $escudo, 'anio'=> $anio);

    }
        
    //desconectamos la base de datos
    $close = mysqli_close($conexion) 
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
    

    
    $json_string = json_encode($equipos);
    echo $json_string;
        
    

?>