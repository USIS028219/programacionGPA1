<?php
 
    include('../../Config/Config.php');

    $Estatus = new Estatus($conexion);

    $proceso = '';

    if ( isset( $_GET['proceso'] ) && strlen( $_GET['proceso'] ) > 0) {
        $proceso = $_GET['proceso'];
    }

    $Estatus->$proceso($_GET['Puestos']);
 
    print_r(json_encode($Estatus->respuesta));


    class Estatus{

        private $datos = array(), $db;
        public $respuesta = ['msg' => 'correcto'];

        public function __construct($db){

            $this->db = $db; 

        }

        public function recibirDatos($Estatus){

            $this->datos = json_decode($Estatus, true);
            $this->validar_datos();

        }

        private function validar_datos(){


            if ( empty( $this->datos['Nombre']) ) {
                
                $this->respuesta['msg'] = 'Por favor ingrese estatus ';

            }

            if( $this->datos['accion'] == 'nuevo'){
                $this->almacenar_estatus();
            }
            else{
                $this->modificar_Estatus();
            }


        }

        private function almacenar_Estatus(){

            if ( $this->respuesta['msg'] == 'correcto') {
                
                if ( $this->datos['accion'] === 'nuevo') {

                    $this->db->consultas('INSERT INTO puesto( puesto) VALUES ("'.$this->datos['Nombre'].'")');

                    $this->respuesta['msg'] = 'Registro insertado correctamente';
                }

            }

        }
        
       
        public function modificar_Estatus(){

            if ( $this->respuesta['msg'] == 'correcto') {
                
                if ( $this->datos['accion'] === 'modificar') {

                    $this->db->consultas('UPDATE puesto SET puesto = "'.$this->datos['Nombre'].'" WHERE estatus.id_estatus =  '.$this->datos['idEstatus']);

                    $this->respuesta['msg'] = 'Registro modificado correctamente';
                }
                
            }
        }

    }

?>