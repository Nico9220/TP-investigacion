<?php
class ABMPersona{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
    
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return object
     */
    
     public function cargarObjeto($param){
        $obj = null;
        
        if(array_key_exists('PerNombre',$param) && array_key_exists('PerDNI',$param) && array_key_exists('PerFechaNac',$param)){
            
            $obj = new Persona();
            
            $obj-> carga($param['PerNombre'], $param['PerDNI'], $param['PerFechaNac']);
            
            
        }
        return $obj;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
     private function seteadosCamposClaves($param){
        
        $resp = false;
        if (isset($param['PerDNI']))
            
            $resp = true;
            return $resp;
    }

     /**
     *
     * @param array $param
     */
    public function alta($param){
        
        $resp = false;
        $elObjtPersona = new Persona();
        $arreglo = $elObjtPersona->listar("PerDNI = ".$param['PerDNI']);
        if(count($arreglo) == 0){
            $elObjtPersona = $this->cargarObjeto($param);
            if ($elObjtPersona!=null && $elObjtPersona->insertar()){
                $resp = true;
            }
        }
        return $resp;
    }

     /**
     * permite eliminar un objeto
     * @param array $param
     * @return boolean
     */
    
     public function baja($param){
        
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)){
            
            $elObjtPersona = $this->cargarObjeto($param);
            
            if ($elObjtPersona !=null and $elObjtPersona->eliminar()){
                
                $resp = true;
            }
        }
        return $resp;
    }

       /** 
    
     * permite modificar un objeto
     * @param array $param
     * @return boolean*/
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            
            $elObjtPersona = $this->cargarObjeto($param);
            
            if($elObjtPersona !=null and $elObjtPersona->modificar()){
                $resp = true;
                
            }
        }
        return $resp;
    }

    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    
     public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if (isset($param['PerDNI'])) {
                $where .= " and PerDNI ='" . $param['PerDNI'] . "'";
            }
            if(isset($param['PerNombre'])){
                $where.=" and PerNombre='".$param['PerNombre']."'";
            } 
            if(isset($param['PerFechaNac'])){
                $where.=" and PerFechaNac='".$param['PerFechaNac']."'";
            }

        }
        $arreglo = Persona::listar($where);
        return $arreglo;
    }
}
?>