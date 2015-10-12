<?php
/**
 * FILE: processors.php
 *
 * @AUTHOR: LTD shalvasoft
 * @AUTHOR: Shalva Kvaratskhelia
 * PROJECT: MVC
 * VERSION: 1.0.0
 */

	if ( ! function_exists('forceHTTPS')){
        /**
         * forcing HTTPS
         */
        function forceHTTPS(){
            $httpsURL = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            if( count( $_POST )>0 )
                die( 'Page should be accessed with HTTPS, but a POST Submission has been sent here. Adjust the form to point to '.$httpsURL );
            if( !isset( $_SERVER['HTTPS'] ) || $_SERVER['HTTPS']!=='on' ){
                if( !headers_sent() ){
                    header( "Status: 301 Moved Permanently" );
                    header( "Location: $httpsURL" );
                    exit();
                }else{
                    die( '<script type="javascript">document.location.href="'.$httpsURL.'";</script>' );
                }
            }
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('redirect')) {
        /**
         * redirecting page
         * @param $filename
         */
        function redirect($filename) {
            if (!headers_sent())
                header('Location: '.$filename);
            else {
                echo '<script type="text/java[ertad]script">';
                echo 'window.location.href="'.$filename.'";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
                echo '</noscript>';
            }
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('domain')) {
        /**
         * returning domain address
         * @return mixed
         */
        function domain(){
            return $_SERVER["SERVER_NAME"];
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('file_get_contents_utf8')){
        function file_get_contents_utf8($fn) {
            $content = file_get_contents($fn);
            return mb_convert_encoding($content, 'UTF-8',
                mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('site_name')) {
        /**
         * returning domain without www
         * @return string
         */
        function site_name(){
            if (strpos(domain(),'www.') !== false) {
                return str_replace('www.','',domain());
            }
            return domain();
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('protocol')) {
        /**
         * returning root directory
         * @return string
         */
        function protocol(){
            if(isset($_SERVER['REQUEST_SCHEME'])) {
                return $_SERVER['REQUEST_SCHEME'];
            }else{
                $isSecure = false;
                if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                    $isSecure = true;
                }
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
                    $isSecure = true;
                }
                return $isSecure ? 'https' : 'http';
            }
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('site_addr')) {
        /**
         * returning domain with protocol
         * @return string
         */
        function site_addr(){
            return protocol() . '://' . domain();
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('root_dir')) {
        /**
         * returning root directory
         * @return string
         */
        function root_dir(){
            return dirname(dirname(dirname(__FILE__)));
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('system_dir')) {
        /**
         * returning system directory full address
         * @return string
         */
        function system_dir(){
            return dirname(dirname(__FILE__));
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('base_url')) {
        /**
         * returning required URL with out domain
         * @return mixed
         */
        function base_url(){
            return $_SERVER['REQUEST_URI'];
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('current_url')) {
        /**
         * returning full address with domain address
         * @return string
         */
        function current_url(){
            return site_addr() . base_url();
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('controllers_dir')) {
        /**
         * returning controllers directory address
         * @return string
         */
        function controllers_dir(){
            return root_dir().'/application/controllers/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('views_dir')) {
        /**
         * returning views directory address
         * @return string
         */
        function views_dir(){
            return root_dir().'/application/views/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('models_dir')) {
        /**
         * returning views directory address
         * @return string
         */
        function models_dir(){
            return root_dir().'/application/models/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('comming_soon')) {
        /**
         * returning comming soon
         * if we need to change it
         * we can send add define in our client side config
         * @return string
         */
        function comming_soon(){
            return defined('Comming_soon') ? Comming_soon : false;
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('db_host')) {
        /**
         * returning database host address
         * @return string
         */
        function db_host(){
            return defined('DB_HOST') ? DB_HOST : 'localhost';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('db_user')) {
        /**
         * returning database username
         * @return string
         */
        function db_user(){
            return defined('DB_USER') ? DB_USER : 'root';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('db_psw')) {
        /**
         * returning database user password
         * @return string
         */
        function db_psw(){
            return defined('DB_PASS') ? DB_PASS : '';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('db_name')) {
        /**
         * returning database name
         * @return string
         */
        function db_name(){
            return defined('DB_NAME') ? DB_NAME : 'demo';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('db_port')) {
        /**
         * returning database name
         * @return string
         */
        function db_port(){
            return defined('DB_PORT') ? DB_PORT : 3306;
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('db_type')) {
        /**
         * returning database type
         * it may be mysql, sqlite or postgresql
         * @return string
         */
        function db_type(){
            return defined('DB_TYPE') ? DB_TYPE : 'mysql';
        }
    }

    // ------------------------------------------------------------------------

    if ( ! function_exists('db_path')) {
        /**
         * returning database type
         * it may be mysql, sqlite or postgresql
         * @return string
         */
        function db_path(){
            return defined('DB_PATH') ? DB_PATH : '';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('js_dir')) {
        /**
         * returning javascript directory
         * @return string
         */
        function js_dir(){
            return defined('Js_dir') ? Js_dir : site_addr().'/js/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('css_dir')) {
        /**
         * returning styles directory
         * @return string
         */
        function css_dir(){
            return defined('Css_dir') ? Css_dir : site_addr().'/css/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('img_dir')) {
        /**
         * returning images directory
         * @return string
         */
        function img_dir(){
            return defined('Img_dir') ? Img_dir : site_addr().'/images/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('font_dir')) {
        /**
         * returning images directory
         * @return string
         */
        function font_dir(){
            return defined('Font_dir') ? Font_dir : site_addr().'/fonts/';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('default_controller')) {
        /**
         * returning default controller file name
         * @return string
         */
        function default_controller(){
            return defined('Default_index') ? Default_index : 'index';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('default_error')) {
        /**
         * returning default error file name
         * @return string
         */
        function default_error(){
            return defined('Default_error') ? Default_error : 'error.php';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('show_errors')) {
        /**
         * show scripting errors or not
         * @return string
         */
        function show_errors(){
            if(defined('Show_errors') && Show_errors == true){
                ini_set('display_errors',1);
                ini_set('display_startup_errors',1);
                error_reporting(-1);
            }else{
                ini_set('display_errors',0);
                ini_set('display_startup_errors',0);
                error_reporting(0);
            }
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('Author_name')) {
        /**
         * returning default error file name
         * @return string
         */
        function Author_name(){
            return 'Shalva Kvaratskhelia';
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('file_get_html')) {
        /**
         * get html dom from file
         * $maxlen is defined in the code as PHP_STREAM_COPY_ALL which is defined as -1.
         *
         * @param $url
         * @param bool|false $use_include_path
         * @param null $context
         * @param int $offset
         * @param bool|true $lowercase
         * @param bool|true $forceTagsClosed
         * @param string $target_charset
         * @param bool|true $stripRN
         * @param string $defaultBRText
         * @param string $defaultSpanText
         * @return bool|simple_html_dom
         */
        function file_get_html($url, $use_include_path = false, $context = null, $offset = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT){
            // We DO force the tags to be terminated.
            $dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
            // For sourceforge users: uncomment the next line and comment the retreive_url_contents line 2 lines down if it is not already done.
            $contents = file_get_contents($url, $use_include_path, $context, $offset);
            // Paperg - use our own mechanism for getting the contents as we want to control the timeout.
            //$contents = retrieve_url_contents($url);
            if (empty($contents) || strlen($contents) > MAX_FILE_SIZE) {
                return false;
            }
            // The second parameter can force the selectors to all be lowercase.
            /** @noinspection PhpUndefinedMethodInspection */
            $dom->load($contents, $lowercase, $stripRN);
            return $dom;
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('str_get_html')) {
        /**
         * get html dom from string
         *
         * @param $str
         * @param bool|true $lowercase
         * @param bool|true $forceTagsClosed
         * @param string $target_charset
         * @param bool|true $stripRN
         * @param string $defaultBRText
         * @param string $defaultSpanText
         * @return bool|simple_html_dom.
         */
        function str_get_html($str, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = true, $defaultBRText = DEFAULT_BR_TEXT, $defaultSpanText = DEFAULT_SPAN_TEXT)
        {
            $dom = new simple_html_dom(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
            if (empty($str) || strlen($str) > MAX_FILE_SIZE) {
                /** @noinspection PhpUndefinedMethodInspection */
                $dom->clear();
                return false;
            }
            /** @noinspection PhpUndefinedMethodInspection */
            $dom->load($str, $lowercase, $stripRN);
            return $dom;
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('dump_html_tree')) {
        /**
         * dump html dom tree
         * @param $node
         */
        function dump_html_tree($node){
            /** @noinspection PhpUndefinedMethodInspection */
            $node->dump($node);
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('timestamp_to_iso8601')) {
        /**
         * convert unix timestamp to ISO 8601 compliant date string
         *
         * @param    int $timestamp Unix time stamp
         * @param    boolean $utc Whether the time stamp is UTC or local
         * @return    mixed ISO 8601 date string or false
         * @access   public
         */
        function timestamp_to_iso8601($timestamp, $utc = true) {
            $datestr = date('Y-m-d\TH:i:sO', $timestamp);
            $pos = strrpos($datestr, "+");
            if ($pos === FALSE) {
                $pos = strrpos($datestr, "-");
            }
            if ($pos !== FALSE) {
                if (strlen($datestr) == $pos + 5) {
                    $datestr = substr($datestr, 0, $pos + 3) . ':' . substr($datestr, -2);
                }
            }
            if ($utc) {
                $pattern = '/' .
                    '([0-9]{4})-' .    // centuries & years CCYY-
                    '([0-9]{2})-' .    // months MM-
                    '([0-9]{2})' .    // days DD
                    'T' .            // separator T
                    '([0-9]{2}):' .    // hours hh:
                    '([0-9]{2}):' .    // minutes mm:
                    '([0-9]{2})(\.[0-9]*)?' . // seconds ss.ss...
                    '(Z|[+\-][0-9]{2}:?[0-9]{2})?' . // Z to indicate UTC, -/+HH:MM:SS.SS... for local tz's
                    '/';

                if (preg_match($pattern, $datestr, $regs)) {
                    return sprintf('%04d-%02d-%02dT%02d:%02d:%02dZ', $regs[1], $regs[2], $regs[3], $regs[4], $regs[5], $regs[6]);
                }
                return false;
            } else {
                return $datestr;
            }
        }
    }


    // ------------------------------------------------------------------------

	if ( ! function_exists('iso8601_to_timestamp')) {
        /**
         * convert ISO 8601 compliant date string to unix timestamp
         *
         * @param    string $datestr ISO 8601 compliant date string
         * @return    mixed Unix timestamp (int) or false
         * @access   public
         */
        function iso8601_to_timestamp($datestr) {
            $pattern = '/' .
                '([0-9]{4})-' .    // centuries & years CCYY-
                '([0-9]{2})-' .    // months MM-
                '([0-9]{2})' .    // days DD
                'T' .            // separator T
                '([0-9]{2}):' .    // hours hh:
                '([0-9]{2}):' .    // minutes mm:
                '([0-9]{2})(\.[0-9]+)?' . // seconds ss.ss...
                '(Z|[+\-][0-9]{2}:?[0-9]{2})?' . // Z to indicate UTC, -/+HH:MM:SS.SS... for local tz's
                '/';
            if (preg_match($pattern, $datestr, $regs)) {
                // not utc
                if ($regs[8] != 'Z') {
                    $op = substr($regs[8], 0, 1);
                    $h = substr($regs[8], 1, 2);
                    $m = substr($regs[8], strlen($regs[8]) - 2, 2);
                    if ($op == '-') {
                        /** @noinspection PhpWrongStringConcatenationInspection */
                        $regs[4] = $regs[4] + $h;
                        /** @noinspection PhpWrongStringConcatenationInspection */
                        $regs[5] = $regs[5] + $m;
                    } elseif ($op == '+') {
                        $regs[4] = $regs[4] - $h;
                        $regs[5] = $regs[5] - $m;
                    }
                }
                return gmmktime($regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1]);
                //		return strtotime("$regs[1]-$regs[2]-$regs[3] $regs[4]:$regs[5]:$regs[6]Z");
            } else {
                return false;
            }
        }
    }

    // ------------------------------------------------------------------------

	if ( ! function_exists('usleepWindows')) {
        /**
         * sleeps some number of microseconds
         *
         * @param    string $usec the number of microseconds to sleep
         * @access   public
         * @deprecated
         */
        function usleepWindows($usec){
            $start = gettimeofday();
            do {
                $stop = gettimeofday();
                $timePassed = 1000000 * ($stop['sec'] - $start['sec'])
                    + $stop['usec'] - $start['usec'];
            } while ($timePassed < $usec);
        }
    }
