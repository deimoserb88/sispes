<?php    

    define('__ROOT__', dirname(dirname(__FILE__)));
    
    require_once(__ROOT__."/config.php");
        
    if($saml->isAuthenticated()){ //Si hay sesi�n iniciada, hacer logout del IDP
        $saml->logout($SP_URL);  	// Se puede pasar como parametro a donde redireccionar tras el logout
    }else {
	header("Location:".$SP_URL); //Si no tenia sesi�n iniciada, lo rirecciona a la url configurada. 
    }
?>
