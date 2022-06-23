<?php
// comprobamos si el usuario ya existe, controlar email y dni
//include("comprobarUsu.php");
//include("valoresFormAltaUsu.php");

//Validamos las variables han llegado y tienen contenido
    if (isset($_POST['nombre'],$_POST['email'],$_POST['password'],$_POST['persona']) and $_POST['nombre'] !="" and $_POST['email']!="" and $_POST['password']!="") {
        // otorgo los valores a las variables
        $nombreIn = $_POST['nombre'];
        $emailIn = $_POST['email'];
        $passwordIn = $_POST['password'];
        $actua_comoIn = $_POST['persona'];
        $dniIn = $_POST['numDoc'];
        
        // me creo el objeto persona
        class Persona {
            // propiedades
            public $nombre;
            protected $email;
            private $password;
            public $actua;

            public function __construct($nombre, $email,$password,$actua) {
                $this->nombre = $nombre;
                $this->email = $email;
                $this->password = $password;
                $this->actua = $actua;

              }
            // Metodos
            function set_nombre($nombre) {
                $this->nombre = $nombre;
                }
            function get_nombre() {
                return $this->nombre;
                }
            function set_email($email) {
                $this->email = $email;
                }
            function get_email() {
                return $this->email;
                }
            function set_password($password) {
                $this->password = $password;
                }
            function get_password() {
                return $this->password;
                }
            function set_actua($actua) {
                $this->actua = $actua;
                }
            function get_actua() {
                return $this->actua;
                }
            // fin métodos
        }
        // fin de la clase persona

        //creo una clase donatario que extiende de persona
        class Donatario extends Persona {
            // propiedades
            private $dni;
            public function __construct($nombre, $email,$password,$actua,$dni) {
                $this->nombre = $nombre;
                $this->email = $email;
                $this->password = $password;
                $this->actua = $actua;
                $this->dni = $dni;
            }
            function set_nombre($nombre) {
                $this->nombre = $nombre;
                }
            function get_nombre() {
                return $this->nombre;
                }
            function set_email($email) {
                $this->email = $email;
                }
            function get_email() {
                return $this->email;
                }
            function set_password($password) {
                $this->password = $password;
                }
            function get_password() {
                return $this->password;
                }
            function set_actua($actua) {
                $this->actua = $actua;
                }
            function get_actua() {
                return $this->actua;
                }
            function set_dni($dni) {
                $this->dni = $dni;
                }
            function get_dni() {
                return $this->dni;
                }

        }
       
        // creo un objeto persona y le otorgo valores
        $persona = new Persona($nombreIn,$emailIn,$passwordIn,$actua_comoIn);


        //creo un objeto donatario y le otorgo el valor
        $donatario = new Donatario($nombreIn,$emailIn,$passwordIn,$actua_comoIn,$dniIn);
        // fin de creación donatario

        // voya a comprobar si el email introducido ya existe en mi tabla personas, en caso afirmativo no daremos de alta.
        include("funciones.php");
        
        if(repEmail($persona)){
            //redirijo al formulario y funciona
            echo 'null';
        } else {
            //doy de alta a una persona en la BD
            $sqlPersona = "INSERT INTO personas (email,nombre,password) VALUES('$emailIn','$nombreIn','$passwordIn')";
            include("conexion.php");
            mysqli_query($con,$sqlPersona);
            // fin alta persona en la BD

            // recojo el valor del idPersona que luego usaré como fk tanto de la tabla donantes como donatarios
         
            $sqlIDPersona = "SELECT id_persona FROM personas 
                            ORDER BY id_persona DESC
                            LIMIT 1";
            $result = mysqli_query($con,$sqlIDPersona);       
            $fila = mysqli_fetch_row($result);
            $idPersona = $fila[0];
            // fin de recoger valor id de persona

            // atendiendo al tipo de usuario insertaré en una tabla (donantes), en otra(donatarios) o en las dos (donantes y donatarios)
            switch (tipoUsuario($persona)) {
                case 1:
                    $sqlDonante = "INSERT INTO donantes (fk_persona_donante)    
                                    VALUES ('$idPersona')";
                    mysqli_query($con,$sqlDonante);
                    
                    $modificacion_sql = "SELECT * 
                    FROM personas p 
                    LEFT JOIN donantes d ON d.fk_persona_donante = p.id_persona 
                    WHERE p.id_persona = $idPersona";

                    $resultado = mysqli_query($con, $modificacion_sql);
                    $arrayResultados = mysqli_fetch_assoc($resultado); 

                    echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);
                    break;
                case 2:
                    $sqlDonatario = "INSERT INTO donatarios (dni,fk_persona_donatario)    
                    VALUES ('$dniIn','$idPersona')";
                    mysqli_query($con,$sqlDonatario);

                    $modificacion_sql = "SELECT * 
                    FROM personas p 
                    LEFT JOIN donatarios d ON d.fk_persona_donatario = p.id_persona
                    WHERE p.id_persona = $idPersona";

                    $resultado = mysqli_query($con, $modificacion_sql);
                    $arrayResultados = mysqli_fetch_assoc($resultado); 

                    echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);
                    break;
                case 3:
                    // inserto usuario en tabla donante
                    $sqlDonaDontDonantes = "INSERT INTO donantes (fk_persona_donante)    
                                                VALUES ('$idPersona')"; 
                    mysqli_query($con,$sqlDonaDontDonantes);
                   
                         
                    // tambien inserto usuario en tabla donantarios
                    $sqlDonaDontDonatarios = "INSERT INTO donatarios (dni,fk_persona_donatario)    
                                                VALUES ('$dniIn','$idPersona')";
                    mysqli_query($con,$sqlDonaDontDonatarios);
                    
                    $modificacion_sql = "SELECT * 
                    FROM personas p 
                    LEFT JOIN donantes d ON d.fk_persona_donante = p.id_persona 
                    LEFT JOIN donatarios dt ON dt.fk_persona_donatario = p.id_persona
                    WHERE p.id_persona = $idPersona";

                    $resultado = mysqli_query($con, $modificacion_sql);
                    $arrayResultados = mysqli_fetch_assoc($resultado); 

                    echo json_encode($arrayResultados, JSON_UNESCAPED_UNICODE);
                    break;
            }
        }
    }
?>