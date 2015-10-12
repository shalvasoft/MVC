<?php

/**
 * FILE: sessions_interface.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */
namespace interfaces;


interface sessions_interface{
    /**
     * start session
     * @return mixed
     */
    public static function Init();

    /**
     * sey session key with value
     * @param $key
     * @param $val
     *
     * @return mixed
     */
    public static function Set($key, $val);

    /**
     * get session value by key
     *
     * @param $name
     *
     * @return mixed
     */
    public static function Get($name);

    /**
     * check if session key exists
     *
     * @param $name
     *
     * @return mixed
     */
    public static function Exists($name);

    /**
     * get session ID
     *
     * @return mixed
     *
     */
    public static function GetID();

    /**
     * set session ID
     *
     * @param $sessionid
     *
     * @return mixed
     */
    public static function SetID ($sessionid);

    /**
     * validate session id
     *
     * @param $session_id
     *
     * @return mixed
     */
    public static function Validate_id($session_id);

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
    public static function Change($sessionid, $key, $val);

    /**
     * Reading session by session ID
     *
     * @param $sessionid
     *
     * @param $key
     *
     * @return mixed
     */
    public static function Read($sessionid, $key);

    /**
     * Remove session by key
     *
     * @param $name
     *
     * @return mixed
     */
    public static function Remove($name);

    /**
     * Destroy all session
     * @return mixed
     */
    public static function Destroy();

    /**
     * Close session
     *
     * @return mixed
     */
    public static function Close ();

}