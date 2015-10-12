<?php

/**
 * FILE: sessions.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

    class sessions implements interfaces\sessions_interface{

        /**
         * start session
         *
         * @return mixed
         */
        public static function Init (){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }

        /**
         * sey session key with value
         *
         * @param $key
         * @param $val
         *
         * @return mixed
         */
        public static function Set ($key, $val){
            $_SESSION[$key] = $val;
        }

        /**
         * get session value by key
         *
         * @param $name
         *
         * @return mixed
         */
        public static function Get ($name){
            if(isset($_SESSION[$name])){
                return $_SESSION[$name];
            }
            return false;
        }

        /**
         * check if session key exists
         *
         * @param $name
         *
         * @return mixed
         */
        public static function Exists ($name){
            if(session_status() == PHP_SESSION_ACTIVE && isset($_SESSION[$name])){
                return true;
            }
            return false;
        }

        /**
         * get session ID
         *
         * @return mixed
         */
        public static function GetID (){
            if(session_status() == PHP_SESSION_ACTIVE){
                return session_id();
            }
            return false;
        }

        /**
         * set session ID
         *
         * @param $sessionid
         *
         * @return mixed
         */
        public static function SetID ($sessionid){
            $file = session_save_path()."/sess_".$sessionid;
            if(file_exists($file)){
                session_id($sessionid);
            }
        }

        /**
         * validate session id
         *
         * @param $session_id
         *
         * @return mixed
         */
        public static function Validate_id($session_id){
            return preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $session_id) > 0;
        }

        /**
         * change session key value by session ID
         *
         * @param $sessionid
         * @param $key
         * @param $val
         *
         * @return mixed
         * @internal param $session_key
         * @internal param $session_val
         *
         */
        public static function Change ($sessionid, $key, $val){
            //Get current session
            self::Init();
            $current_id = self::GetID();
            self::Close();
            self::SetID($sessionid);
            session_start();
            //Set superglobal value
            $_SESSION[$key]=$val;
            self::Close();
            //Set the before session
            session_id($current_id);
            session_start();
        }

        /**
         * Reading session by session ID
         *
         * @param $sessionid
         *
         * @param $key
         *
         * @return mixed
         */
        public static function Read ($sessionid, $key){
            //Get current session
            self::Init();
            $current_id = self::GetID();
            self::Close();
            self::SetID($sessionid);
            session_start();
            //Get superglobal value
            $value=null;
            if(isset($_SESSION[$key]))$value=$_SESSION[$key];
            self::Close();
            //Set the before session
            session_id($current_id);
            session_start();
            return $value;
        }

        /**
         * Remove session by key
         *
         * @param $name
         *
         * @return mixed
         */
        public static function Remove ($name){
            if(isset($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
        }

        /**
         * Destroy all session
         *
         * @return mixed
         */
        public static function Destroy (){
            if(session_status() == PHP_SESSION_ACTIVE){
                session_destroy();
            }
        }

        /**
         * Close session
         *
         * @return mixed
         */
        public static function Close (){
            if(session_status() == PHP_SESSION_ACTIVE){
                session_write_close();
            }
        }
    }