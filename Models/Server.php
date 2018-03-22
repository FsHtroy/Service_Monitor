<?php
    class Server {
        private $host;
        private $check_port;
        private $service;
        public $location;
        public $serviceStatus;

        public function __construct($host, $location, $check_port, $service)
        {
            $this->host = $host;
            $this->location = $location;
            $this->check_port = $check_port;
            $this->service = $service;
        }

        public function checkServer($target_port) {
            $fp = @fsockopen($this->host,$target_port,$errNo,$errStr,1);
            if (!$fp) {
                return false;
            } else {
                fclose($fp);
                return true;
            }
        }

        /**
         * @return mixed
         */
        public function getCheckPort() {
            return $this->check_port;
        }

        public function setServiceStatus($serviceStatus, $tarService)
        {
            $this->serviceStatus[] = Array($this->service[$tarService], $serviceStatus);
        }

    }