<?php
/**
 *  Session class goes here
 */
class Session {

    public static function init(){
        @session_start();
    }
    public static function set($key ,$value){
        $_SESSION[$key] = $value;
    }
    public static function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }
    public static function checkSession(){
        self::init();
        if(self::get('loggedin')!=true){
            self::destroy();
        }
    }
    public static function checkLogin(){
        self::init();
        if(self::get('loggedin') == true){
            echo '<script>location.href = "index.php"</script>';
        }
    }
    public static function destroy(){
        session_destroy();
        echo '<script>location.href = "signin.php" </script>';
    }
}
?>