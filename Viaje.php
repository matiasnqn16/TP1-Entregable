<?php
class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $datosPasajeros = [];

    public function __construct($codigoViaje,$destino,$cantMaxPasajeros,$datosPasajeros){
        $this->codigoViaje = $codigoViaje;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->datosPasajeros = $datosPasajeros;
    }

    public function getCodigoViaje(){
        return $this->codigoViaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getDatosPasajeros(){
        return $this->datosPasajeros;
    }

    public function setCodigoViaje($codigoViajeN){
        $this->codigoViaje = $codigoViajeN;
    }
    public function setDestino($destinoN){
        $this->destino = $destinoN;
    }
    public function setCantMaxPasajeros($cantMaxPasajerosN){
        $this->cantMaxPasajeros = $cantMaxPasajerosN;
    }
    public function setDatosPasajeros($datosPasajerosN){
        $this->datosPasajeros = $datosPasajerosN;
    }

    /* funcion que cambia destino */
    /* @param string $nuevoDestino */
    /* @return void */
    public function cambiarDestino($nuevoDestino){
        $this->setDestino($nuevoDestino);
    }
    /* funcion que cambia codigo del viaje */
    /* @param int $nuevoCodigo */
    /* @return void */
    public function cambiarCodigoViaje($nuevoCodigo){
        $this->setCodigoViaje($nuevoCodigo);
    }
    /* funcion que cambia la cantidad maxima de pasajeros dependiendo de los pasajeros inscriptos */
    /* @param int $nuevaCantidad */
    /* @return boolean */
    public function cambiarMaxDePasajeros($nuevaCantidad){
        if($nuevaCantidad > count($this->getDatosPasajeros())-1){
            $this->setCantMaxPasajeros($nuevaCantidad);
            return true;
        }else
        return false;
    }
    /* funcion que agrega pasajeros hasta que supere la capacidad maxima */
    /* @param array $arrayNuevosPasajeros */
    /* @return boolean */
    public function agregarPasajero($arrayNuevosPasajeros){
        if (count($this->getDatosPasajeros()) < $this->getCantMaxPasajeros()){
            $screenshotDatosPasajeros = $this->getDatosPasajeros();
            array_push($screenshotDatosPasajeros,$arrayNuevosPasajeros);
            $this->setDatosPasajeros($screenshotDatosPasajeros);
            return true;
        }else
        return false;
    }
    /* funcion que quita pasajero segun su posicion dentro del array asociativo */
    /* @param int $posicionPasajero */
    /* @return boolean */
    public function quitarPasajero($posicionPasajero){
        if ($posicionPasajero < count($this->getDatosPasajeros())+1){
            $screenshotDatosPasajeros = $this->getDatosPasajeros();
            unset($screenshotDatosPasajeros[($posicionPasajero-1)]);
            $this->setDatosPasajeros(array_values($screenshotDatosPasajeros));
            return true;
        }else
        return false;
    }

    public function listarPasajeros(){
        $texto = "pos -  Nombre y Apellido   -   Dni \n";
        foreach($this->getDatosPasajeros() as $val => $dat){
            $texto .= "| ".($val+1)." "." -  ".$dat['Nombre']." ".$dat['Apellido']." - ".$dat['NroDocumento']."\n";
        }
        return $texto;
    }

    public function __toString(){
        return "\nviaje n° ".$this->getCodigoViaje()."\n". 
        "Con destino a: ".$this->getDestino()."\n". 
        "Cant. Max. de pasajeros ".$this->getCantMaxPasajeros()."\n". 
        "Cantidad de pasajeros: ".count($this->getDatosPasajeros())."\n\n". 
        "Pasajeros:\n ".$this->listarPasajeros()."\n";
    }
}
?>