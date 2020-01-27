<?php
    
    //Creamos la conexión
    
    $conexion = mysqli_connect("192.168.254.2", "usuario", "1234", "db") 
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    
   
    if(isset($_GET) and $_GET['equipo']!=="")
    {    
      
        //generamos la consulta
        $equipo=$_GET['equipo'];
        $sql = "select * from JUGADORES where EQUIPO='".$equipo."'";
        $cadenaFiltros=obtenerFiltros();
        
        //concatenamos los filtros a la consulta
        $sql=$sql.$cadenaFiltros;
        

        mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

        if(!$result = mysqli_query($conexion, $sql)) die();

        $jugadores =[]; //creamos un array

     
        while($row = mysqli_fetch_array($result)) 
        { 
            $nombre=$row['NOM_JUG'];
            $edad=$row['EDAD'];
            $nac=$row['NACIONALIDAD'];
            $pos=$row['POSICION'];
            
            

            $jugadores[] = array('nombre'=> $nombre, 'edad'=> $edad, 'nacionalidad'=> $nac, 'posicion'=> $pos);

        }
        
            
        //desconectamos la base de datos
        $close = mysqli_close($conexion) 
        or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
        

        
        $json_string = json_encode($jugadores);
        echo $json_string;
    }
    
    function obtenerFiltros()
    {
        $filtro="";

        if($_GET["edad"]!=='-')
        {
            $filtro=$filtro." and EDAD=".$_GET['edad'];
        }
        if($_GET["pos"]!=='-')
        {
            $filtro=$filtro." and POSICION='".$_GET['pos']."'";
        }
        if($_GET["nacion"]!=='-')
        {
            $filtro=$filtro." and NACIONALIDAD='".$_GET['nacion']."'";
        }

        return $filtro;
    }
    

?>