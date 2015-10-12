<?php
/**
 * FILE: defines.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

if (!defined('T_NAMESPACE')){
    define('T_NAMESPACE', -1);
    define('T_NS_SEPARATOR', -1);
}
if (!defined('T_TRAIT')) define('T_TRAIT', -1);
if (!defined('HDOM_TYPE_ELEMENT'))      define('HDOM_TYPE_ELEMENT', 1);
if (!defined('HDOM_TYPE_COMMENT'))      define('HDOM_TYPE_COMMENT', 2);
if (!defined('HDOM_TYPE_TEXT'))         define('HDOM_TYPE_TEXT',    3);
if (!defined('HDOM_TYPE_ENDTAG'))       define('HDOM_TYPE_ENDTAG',  4);
if (!defined('HDOM_TYPE_ROOT'))         define('HDOM_TYPE_ROOT',    5);
if (!defined('HDOM_TYPE_UNKNOWN'))      define('HDOM_TYPE_UNKNOWN', 6);
if (!defined('HDOM_QUOTE_DOUBLE'))      define('HDOM_QUOTE_DOUBLE', 0);
if (!defined('HDOM_QUOTE_SINGLE'))      define('HDOM_QUOTE_SINGLE', 1);
if (!defined('HDOM_QUOTE_NO'))          define('HDOM_QUOTE_NO',     3);
if (!defined('HDOM_INFO_BEGIN'))        define('HDOM_INFO_BEGIN',   0);
if (!defined('HDOM_INFO_END'))          define('HDOM_INFO_END',     1);
if (!defined('HDOM_INFO_QUOTE'))        define('HDOM_INFO_QUOTE',   2);
if (!defined('HDOM_INFO_SPACE'))        define('HDOM_INFO_SPACE',   3);
if (!defined('HDOM_INFO_TEXT'))         define('HDOM_INFO_TEXT',    4);
if (!defined('HDOM_INFO_INNER'))        define('HDOM_INFO_INNER',   5);
if (!defined('HDOM_INFO_OUTER'))        define('HDOM_INFO_OUTER',   6);
if (!defined('HDOM_INFO_ENDSPACE'))     define('HDOM_INFO_ENDSPACE',7);
if (!defined('DEFAULT_TARGET_CHARSET')) define('DEFAULT_TARGET_CHARSET', 'UTF-8');
if (!defined('DEFAULT_BR_TEXT'))        define('DEFAULT_BR_TEXT', "\r\n");
if (!defined('DEFAULT_SPAN_TEXT'))      define('DEFAULT_SPAN_TEXT', " ");
if (!defined('MAX_FILE_SIZE'))          define('MAX_FILE_SIZE', 600000);

$GLOBALS['_transient']['static']['nusoap_base']['globalDebugLevel'] = 9;