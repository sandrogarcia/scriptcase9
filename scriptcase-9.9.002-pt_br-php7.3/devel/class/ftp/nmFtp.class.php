<?php
class ClsFTP{
        var $host = "localhost";//FTP HOST
        var $port = "21";                //FTP port
        var $user = "Anonymous";//FTP user
        var $pass = "Email";        //FTP password
        var $link_id = "";                //FTP hand
        var $is_login = "";                //is login
        var $debug = 1;
        var $local_dir = "";        //local path for upload or download
        var $rootdir = "";                //FTP root path of FTP server
        var $dir = "/";                        //FTP current path
        var $erro = "";                        //FTP current erro


        function __construct($user="Anonymous",$pass="Email",$host="localhost",$port="21"){
                if($host) $this->host = $host;
                if($port) $this->port = $port;
                if($user) $this->user = $user;
                if($pass) $this->pass = $pass;
                $this->login();
                if($this->erro=="")
                {
                        $this->rootdir         = $this->pwd();
                        $this->dir                 = $this->rootdir;
                }
        }
        function halt($msg)
        {
                $this->erro = $msg;
                $connect = false;
        }
        function login(){
                if(!$this->link_id){
                        $this->link_id = ftp_connect($this->host,$this->port) or $this->halt('cant_connect');
                }
                if($this->erro=="")
                {
                        if(!$this->is_login){
                                $this->is_login = ftp_login($this->link_id, $this->user, $this->pass) or $this->halt('bad_login');
                        }
                        ftp_pasv($this->link_id, TRUE);
                }
        }
        function systype(){
                return ftp_systype($this->link_id);
        }
        function pwd(){
                $dir = ftp_pwd($this->link_id);
                $this->dir = $dir;
                return $dir;
        }
        function cdup(){
                $isok =  ftp_cdup($this->link_id);
                if($isok) $this->dir = $this->pwd();
                return $isok;
        }
        function cd($dir){
                    try {
                        $isok = @ftp_chdir($this->link_id, $dir);
                        if ($isok) {
                            $this->dir = $dir;
                            return true;
                        }
                        return false;
                    } catch( Exception $e){
                        return false;
                    }

        }
        function nlist($dir=""){
                if(!$dir) $dir = ".";
                $arr_dir = @ftp_nlist($this->link_id,$dir);
                return $arr_dir;
        }
        function rawlist($dir="/"){
                $arr_dir = @ftp_rawlist($this->link_id,$dir);
                return $arr_dir;
        }
        function mkdir($dir){
                $retorno = true;

                $dir = str_replace("\\", "/", $dir);

                $arr_dir = array();
                $nivel = "";
                if(strpos($dir, "/")!==false)
                {
                        $arr_dir = explode("/", $dir);
                }else
                {
                        $arr_dir[] = $dir;
                }
                try {

                    foreach ($arr_dir as $dir) {
                        if(!$this->exists($dir)){
                            @ftp_mkdir($this->link_id, $dir);
                        }
                        if ($this->cd($dir)) {
                            $nivel .= "../";
                        }
                    }

                    $this->cd($nivel);
                } catch( Exception $e){

                }

                return $retorno;
        }
        function file_size($file){
                $size = ftp_size($this->link_id,$file);
                return $size;
        }
        function chmod($file,$mode=0666){
                return ftp_chmod($this->link_id,$file,$mode);
        }
        function delete($remote_file){
                return ftp_delete($this->link_id,$remote_file);
        }
        function get($local_file,$remote_file,$mode=FTP_BINARY){
                return ftp_get($this->link_id,$local_file,$remote_file,$mode);
        }
        function put($remote_file,$local_file,$mode=FTP_BINARY){
                return ftp_put($this->link_id,$remote_file,$local_file,$mode);
        }
        function put_string($remote_file,$data,$mode=FTP_BINARY){
                $tmp = "/tmp";//ini_get("session.save_path");
                $tmpfile = tempnam($tmp,"tmp_");
                $fp = fopen($tmpfile,"w+");
                if($fp){
                        fwrite($fp,$data);
                        fclose($fp);
                }else return 0;
                $isok = $this->put($remote_file,$tmpfile,FTP_BINARY);
                unlink($tmpfile);
                return $isok;
        }
        function p($msg){
                echo "<pre>";
                print_r($msg);
                echo "</pre>";
        }

        function close(){
                ftp_quit($this->link_id);
        }

    function exists($dir)
    {
        $arr_files = ftp_nlist($this->link_id, '.');
        if(in_array($arr_files, ['./'.$dir, '.'.$dir, $dir, '\\'.$dir])) {
            return true;
        } else {
            return false;
        }
    }
}

?>