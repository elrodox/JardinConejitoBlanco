<?php 

class UsuarioAuth extends CController
{
    // public methods
    private static $model;
    private static $loggedOn=false;
    
    public static function getModel(){
        return UsuarioAuth::$model;
    }
    public static function isLoggedOn(){
        return UsuarioAuth::$loggedOn;
    }
    
    public static function isParvulo(){
        if( UsuarioAuth::isLoggedOn() )
            if (UsuarioAuth::$model->hasAttribute('rut_parvulo') )
                return true;
    }
    public static function isEducadora(){
        return  UsuarioAuth::isLoggedOn()
                && UsuarioAuth::$model->hasAttribute('rut_educadora');
    }
    public static function isAdmin(){
        return  UsuarioAuth::isLoggedOn() 
                && UsuarioAuth::isEducadora() 
                && UsuarioAuth::$model->hasAttribute('administrador') 
                && UsuarioAuth::$model->administrador==1;
    }
    
    public static function auth(){
        //ChromePhp::log("tamo en auth");
        // $auth_params = UsuarioAuth::authRequest();
        //if($auth_params==null) return false;
        return ( UsuarioAuth::auth_by_password_or_token($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) ) !== false;
        //return true;
    }
    
    public static function authAndGetUser(){
        // $auth_params = UsuarioAuth::authRequest();
        // if($auth_params==null) return false;
        return UsuarioAuth::auth_by_password_or_token($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
    }
    
    // private methods
    
    private static function generarToken(){
        return substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',15)),0,15);
    }
    
    private static function setLoggedOn($user){
        
        // UsuarioAuth::$model = $user;
        // if ( UsuarioAuth::isEducadora() ) {
        //     $user = Educadora::model()->findByAttributes(array('id_educadora'=>$user->id_educadora));
        // }
        // else if ( UsuarioAuth::isParvulo() ){
        //     $user = Parvulo::model()->findByAttributes(array('id_parvulo'=>$user->id_parvulo));
        // }
        $user->password=null;
        UsuarioAuth::$model = $user;
        UsuarioAuth::$loggedOn = true;
        return UsuarioAuth::$model;
    }
    
    private static function auth_by_password_or_token($rut, $key) {
        $user = Educadora::model()->findByAttributes(array('rut_educadora'=>$rut));
        if( $user != null && $user->eliminado == 0){
            if($user->password == $key){
                $user->token = UsuarioAuth::generarToken();
                if ($user->save()){
                    return UsuarioAuth::setLoggedOn($user);
                } else { return false; }
            }else if($user->token == $key){
                return UsuarioAuth::setLoggedOn($user);
            }else return false;
        }else{
            $user = Parvulo::model()->findByAttributes(array('rut_parvulo'=>$rut));
            if( $user != null && $user->eliminado == 0){
                if( $user->password == $key){
                    $user->token = UsuarioAuth::generarToken();
                    if($user->save()){
                        return UsuarioAuth::setLoggedOn($user);
                    }
                    else return false;
                }else if($user->token == $key){
                    return UsuarioAuth::setLoggedOn($user);
                }
                else return false; 
            }
        }
        return false;
    }
    
    
//     protected static function bodyRequest(){
// 		return CJSON::decode(file_get_contents('php://input'));
// 	}
// 	protected static function authRequest(){
// 		if( isset($_GET['user']) && isset($_GET['pass'])){
// 			return array($_GET['user'], $_GET['pass']);
// 		}else if( isset($_POST['user']) && isset($_POST['pass'])){
// 			return array($_POST['user'], $_POST['pass']);
// 		}else if( isset(UsuarioAuth::bodyRequest()['auth']) ){
// 		    return UsuarioAuth::bodyRequest()['auth'];
// 		}
// 		else return null;
// 	}

    // private function auth_token($rut, $token) {
    //     $user = Educadora::model()->findByAttributes(array('rut_educadora'=>$rut));
    //     if( $user != null){
    //         if ($user->token == $token) return $user;
    //         else return false;
    //     }else{
    //         $user = Parvulo::model()->findByAttributes(array('rut_parvulo'=>$rut));
    //         if( $user != null && $user->token == $token)
    //             return $user;
    //     }
    //     return false;
    // }
}