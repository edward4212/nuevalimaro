<?php
class Conexion extends PDO
{
    public $conn = null;
    private $ultimoId = null;
    private static $instancia = null;
    
    private function __construct()
    {
        parent::__construct('mysql:dbname=nuevalimaro;host=localhost','root','');
        // parent::__construct('mysql:dbname=ulimaro2se_coopeaipe2;host=localhost','ulimaro2se_edward','Kddbjw8b3d%');
        $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function ultimoId()
    {
        $sql = "SELECT LAST_INSERT_ID() as lastid";
        $this->ultimoId = $this->query($sql);
        $respuesta = $this->ultimoId->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta[0]['lastid'];
    }

    public static function singleton()
    {
        if(!self::$instancia){
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public static function cerrar()
    {
       self::$instancia = null;
    }
}
?>