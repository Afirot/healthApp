<?php
    class registro{
        private $usuario;
        public $pass;
        public $pass2;
        private function __construct($usuario_,$pass_,$pass2_) {
            $registro->usuario=$usuario_;
            $registro->pass=$pass_;
            $registro->pass2=$pass2_;
        }
        function comprobarPass(){
            if($registro->pass != $registro->pass2){
                while(True){
                    $salida='<html>
                             <head>
                             <meta charset="UTF-8">
                                <!--<link rel="stylesheet" href="css/styles.css">-->
                                <title></title>
                             </head>
                             <body>
                                 <form class="registro" action="resgistrarUsuario.php" method="post">
                                     <h1>Login</h1>
                                     <label>Usuario</label>
                                     <div>
                                        <input type="text" name="nombre" value="" placeholder="Username"/>
                                     </div>
                                         <label>Contraseña</label>
                                     <div>
                                         <input type="password" name="pass" value="" placeholder="Password"/>
                                     </div>
                                    
                                     <label>Repite la contraseña</label>                                    
                                     <div>
                                        <input type="password" name="pass2" value="" placeholder="Password"/>
                                     </div>';
                    return $salida;
                }
            }
        }
    }
?>