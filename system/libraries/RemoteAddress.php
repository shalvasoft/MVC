<?php/** * FILE: RemoteAddress.php * * @AUTHOR: LTD shalvasoft * @AUTHOR: Shalva Kvaratskhelia * PROJECT: MVC * VERSION: 1.0.0 */    class RemoteAddress{        protected $useProxy = false;        protected $trustedProxies = array();        protected $proxyHeader = 'HTTP_X_FORWARDED_FOR';        public function setUseProxy($useProxy = true){            $this->useProxy = $useProxy;            return $this;        }        public function getUseProxy(){            return $this->useProxy;        }        public function setTrustedProxies(array $trustedProxies){            $this->trustedProxies = $trustedProxies;            return $this;        }        public function setProxyHeader($header = 'X-Forwarded-For'){            $this->proxyHeader = $this->normalizeProxyHeader($header);            return $this;        }        public function getIpAddress(){            $ip = $this->getIpAddressFromProxy();            if ($ip) {                return $ip;            }            if (isset($_SERVER['REMOTE_ADDR'])){                return $_SERVER['REMOTE_ADDR'];            }            return '';        }        protected function getIpAddressFromProxy(){            if (!$this->useProxy || (isset($_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $this->trustedProxies))){                return false;            }            $header = $this->proxyHeader;            if (!isset($_SERVER[$header]) || empty($_SERVER[$header])){                return false;            }            $ips = explode(',', $_SERVER[$header]);            $ips = array_map('trim', $ips);            $ips = array_diff($ips, $this->trustedProxies);            if (empty($ips)) {                return false;            }            $ip = array_pop($ips);            return $ip;        }        protected function normalizeProxyHeader($header){            $header = strtoupper($header);            $header = str_replace('-', '_', $header);            if (0 !== strpos($header, 'HTTP_')){                $header = 'HTTP_' . $header;            }            return $header;        }    }