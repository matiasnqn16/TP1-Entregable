<?php
include "Viaje.php";
$Pasajeros = [];
array_push($Pasajeros,['Nombre' => "armando",'Apellido' => "asados",'NroDocumento' => 23452123]);
array_push($Pasajeros,['Nombre' => "bebiendo",'Apellido' => "bebidas",'NroDocumento' => 26342123]);
array_push($Pasajeros,['Nombre' => "carlos",'Apellido' => "carnazita",'NroDocumento' => 23785123]);
array_push($Pasajeros,['Nombre' => "david",'Apellido' => "dedos",'NroDocumento' => 23745123]);
array_push($Pasajeros,['Nombre' => "ernesto",'Apellido' => "estrados",'NroDocumento' => 23734123]);
array_push($Pasajeros,['Nombre' => "fulano",'Apellido' => "falso",'NroDocumento' => 23232123]);
array_push($Pasajeros,['Nombre' => "gaston",'Apellido' => "gatos",'NroDocumento' => 23444123]);

$miViaje = new Viaje(43252,"brazil",10,$Pasajeros);

/* ---------------------------------SECTOR DE FUNCIONES-------------------------------------------------- */

/* funcion que imprime el menu principal */
/* @return int */
function menuPrincipal(){
    echo "------------------Viaje Feliz--------------------\n";
    echo "--------------///Menu principal///---------------\n";
    echo "1 - Visualizar viaje Actual \n";
    echo "2 - Ver y modificar Destino \n";
    echo "3 - ver y modificar Codigo de Viaje \n";
    echo "4 - ver y quitar Pasajeros \n";
    echo "5 - agregar nuevo Pasajero \n";
    echo "6 - visualizar Pasajeros \n";
    echo "7 - ver capacidad maxima y modificar\n";
    echo "8 - Terminar y Salir\n \n";
    do{
		echo "\n" . "Seleccione su opcion: ";
		$selector = trim (fgets(STDIN));
			if($selector > 0 && $selector < 9){
				$retorno = $selector;
			}else{
				echo "la seleccion es invalida"."\n". 
                "Porfavor ingrese una opcion del 1 al 8." . "\n";
				$retorno = 0;
			}
	}while($selector > 9);		
		return ($retorno);
}
/* funcion para listar pasajeros de un array asociativo */
/* @param array $listasPas */
/* @return void */
function listarListaPasajeros($listasPas){
    foreach($listasPas as $val => $dat){
        echo "posicion: ".($val+1)." "." Nombre: ".$dat['Nombre']." ".$dat['Apellido']. 
        "    DNI: ".$dat['NroDocumento']."\n";
    }
}
/* Opciones para modificar la capacidad maxima */
/* @param object $miViaje */
/* @return void */
function opcionesCapMax($miViaje){
    do{
        echo "La cantidad Maxima de pasajeros es de ".$miViaje->getCantMaxPasajeros()." Personas.\n\n";
        echo "1 - reconfigurar la cantidad de pasajeros\n";
        echo "2 - volver al menu principal\n";
        $opc = trim(fgets(STDIN));
            if($opc == 1){
                echo "ingrese la nueva capacidad maxima: ";
                $nuevaCapacidad = trim(fgets(STDIN));
                if ($miViaje->cambiarMaxDePasajeros($nuevaCapacidad)){
                    echo "se ha cambiado con exito el maximo de personas!\n";
                }else
                echo "No se puede modificar porque ya hay personas inscriptas que superan ese maximo! :(";

            }if($opc == 2){
                return 0;
            }
     }while(1);
}
/* ver la lista de todos los pasajeros */
/* @param object $miViaje */
/* @return void */
function visualizarListaPasajeros($miViaje){
    do{
        echo "-------- N°-- Pasajero ----- Nro Documento\n";
        listarListaPasajeros($miViaje->getDatosPasajeros());
        echo "\n \n";
        echo "1 - salir\n";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            return 0;
        }
    }while (1);
}
/* Funcion que quita del array de pasajeros segun el indice que se le otorgue */
/* @param object $miViaje */
/* @return void */
function quitarUnPasajero($miViaje){
    do{
        echo "-------- N°-- Pasajero ----- Nro Documento\n";
        listarListaPasajeros($miViaje->getDatosPasajeros());
        echo "\n";
        echo "1 - quitar pasajero\n";
        echo "2 - salir al menu principal\n";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "Ingrese la posicion del pasajero a quitar: ";
            $quitar = trim(fgets(STDIN));
            if ($miViaje->quitarPasajero($quitar)){
            }else
            echo "esa posicion no existe \n";
        }if($opc == 2){
            return 0;
        }
    }while(1);
}
/* funcion para agregar mas pasajeros */
/* @param object $miViaje */
/* @return void */
function agregarPasajerosAlViaje($miViaje){
    do{
        echo "Restan ".($miViaje->getCantMaxPasajeros()-count($miViaje->getDatosPasajeros()))." Lugares\n";
        if(($miViaje->getCantMaxPasajeros()-count($miViaje->getDatosPasajeros())) == 0){
            return 0;
        }
        echo "A continuacion se pediran los datos del pasajero\n";
        echo "Nombre: ";
        $nombre=trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido=trim(fgets(STDIN));
        echo "DNI: ";
        $dni=trim(fgets(STDIN));
        if ($miViaje->agregarPasajero(['Nombre' => $nombre,'Apellido' => $apellido,'NroDocumento' => $dni])){
        }else
        echo "Excede el maximo de personas a bordo\n";
        return 0;
    }while(1);
}
/* funcion para cambiar destino */
/* @param object $miViaje */
/* @return void */
function cambiarDestino($miViaje){
    do{
        echo "\nEl destino actual es: ". $miViaje->getDestino(). "\n\n";
        echo "1 - Cambiar destino\n";
        echo "2 - volver al menu principal\n";
        echo "Eleccion: ";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "\nIngrese el nuevo destino: ";
            $nDestino = trim(fgets(STDIN));
            $miViaje->cambiarDestino($nDestino);
        }if($opc == 2){
            return 0;
        }

    }while(1);
}
/* funcion para cambiar codigo de viaje */
/* @param object $miViaje */
/* @return void */
function cambiarCodigoDeViaje($miViaje){
    do{
        echo "\nEl codigo de viaje actual es: ". $miViaje->getCodigoViaje(). "\n\n";
        echo "1 - Cambiar Codigo de viaje\n";
        echo "2 - volver al menu principal\n";
        echo "Eleccion: ";
        $opc = trim(fgets(STDIN));
        if($opc == 1){
            echo "\nIngrese el nuevo codigo de viaje: ";
            $nCodigo = trim(fgets(STDIN));
            $miViaje->cambiarCodigoViaje($nCodigo);
        }if($opc == 2){
            return 0;
        }
    }while(1);
}
/* ------------------------ FIN SECTOR DE FUNCIONES ---------------------------------- */


/* -------------inicio programa---------- */
do{
    $opcion = menuPrincipal();

    if ($opcion == 1){
        echo $miViaje;
    }
    if ($opcion == 2){
        cambiarDestino($miViaje);
    }
    if ($opcion == 3){
        cambiarCodigoDeViaje($miViaje);
    }
    if ($opcion == 4){
        quitarUnPasajero($miViaje);
    }
    if ($opcion == 5){
        agregarPasajerosAlViaje($miViaje);
    }
    if ($opcion == 6){
        visualizarListaPasajeros($miViaje);
    }
    if ($opcion == 7){
        opcionesCapMax($miViaje);
    }
    if ($opcion == 8){
        return 0;
    }

}while(1); 
?>