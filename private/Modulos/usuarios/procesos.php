<?php 
include('../../Config/Config.php');
$usuarios = new usuarios($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$alumno->$proceso( $_GET['usuarios'] );
print_r(json_encode($usuarios->respuesta));

class usuarios{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];

    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($usuarios){
        $this->datos = json_decode($usuarios, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['codigo']) ){
            $this->respuesta['msg'] = 'por favor ingrese el codigo del usuarios';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del usuarios';
        }
        if( empty($this->datos['apellido']) ){
            $this->respuesta['msg'] = 'por favor ingrese la direccion del usuarios';
        }
        $this->almacenar_usuarios();
    }
    private function almacenar_usuarios(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO perfil_de_usuario (codigo,nombre, apellido,genero,estatus,fecha_de_nacimiento, dui, nit, usuario contraseña) VALUES(
                        "'. $this->datos['codigo'] .'",
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['apellido'] .'",
                        "'. $this->datos['genero'] .'"
                        "'. $this->datos['estatus'] .'"
                        "'. $this->datos['fecha_de_nacimiento'] .'"
                        "'. $this->datos['dui'] .'"
                        "'. $this->datos['nit'] .'"
                        "'. $this->datos['usuario'] .'"
                        "'. $this->datos['contraseña'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                   UPDATE alumnos SET
                        codigo     = "'. $this->datos['codigo'] .'",
                        nombre     = "'. $this->datos['nombre'] .'",
                        direccion  = "'. $this->datos['direccion'] .'",
                        telefono   = "'. $this->datos['telefono'] .'"
                    WHERE idAlumno = "'. $this->datos['idAlumno'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarAlumno($valor=''){
        $this->db->consultas('
            select alumnos.idAlumno, alumnos.codigo, alumnos.nombre, alumnos.direccion, alumnos.telefono
            from alumnos
            where alumnos.codigo like "%'.$valor.'%" or alumnos.nombre like "%'.$valor.'%"
        ');
        return $this->respuesta = $this->db->obtener_datos();
    }
    public function eliminarAlumno($idAlumno=''){
        $this->db->consultas('
            delete alumnos
            from alumnos
            where alumnos.idAlumno = "'.$idAlumno.'"
        ');
        $this->respuesta['msg'] = 'Registro eliminado correctamente';
    }
}
?>