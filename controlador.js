var app=angular.module("APP",[]);
app.controller("controlador",function($scope, $http){

    $scope.listaJson=[];
    var lista=[];
    $scope.verDatos=[];//mostrará los datos del framework si el usuario pincha en él(diccionaerio banderas)
    $scope.buscador="";
    
    $http.get("https://my-json-server.typicode.com/javiGeno/front_back/db")
    .then(function(response){//el parametro recibido es lo que retorna el servidor
        
        
        lista=response.data.frameworks;
        $scope.listaJson=lista;
        addBanderas();
       

    });

    function addBanderas()
    {
        console.log($scope.listaJson);
        console.log($scope.listaJson[0].toString())
        for (frame in $scope.listaJson)
        {
            console.log(frame);//numero
            $scope.verDatos[$scope.listaJson[frame].nombre]=false;//ponemos las banderas de cada frame a falso para los datos
            
        }
        console.log($scope.verDatos);
    }
    
    $scope.seeDate=function(obj)
    {
        if($scope.verDatos[obj.nombre]==false)
        {
            $scope.verDatos[obj.nombre]=true;
        }
        else
        {
            $scope.verDatos[obj.nombre]=false;
        }
    }

    $scope.buscar=function()
    {

        var filtro=$scope.buscador;
        filtro=filtro.toLowerCase();
        var listaAux=[];
        var encontrado=false;
        
        if(filtro=="")
        {
            $scope.listaJson=lista;
        }
        else
        {
            $scope.listaJson=lista;

            for(var i=0; i<$scope.listaJson.length; i++)
            {
                
                    encontrado=false;
                    
                    if($scope.listaJson[i].tipo.toLowerCase().includes(filtro))
                    {
                        encontrado=true;
                    }
                    else
                    {
                        if($scope.listaJson[i].nombre.toLowerCase().includes(filtro))
                        {
                            encontrado=true;
                        }
                        else
                        {
                            if($scope.listaJson[i].lanzamiento.toString().includes(filtro))
                            {
                                encontrado=true;
                            }
                            else
                            {
                               
                                    if($scope.listaJson[i].compatibilidad.toString().toLowerCase().includes(filtro))
                                    {
                                        encontrado=true;
                                    }
                                    else
                                    {
                                       
                                        if(typeof $scope.listaJson[i].compatibilidad!=='string' && typeof $scope.listaJson[i].compatibilidad!=='object')
                                        {
                                            
                                            if($scope.listaJson[i].compatibilidad.toLowerCase().includes(filtro))
                                                encontrado=true;
                                        }
                                        
                                    }
                               
                            }
                            
                        }

                    }

                    if(encontrado)
                    {
                        listaAux.push($scope.listaJson[i]);
                    }
                  
                
            }

            $scope.listaJson=listaAux;
        }
        
           
    }
});