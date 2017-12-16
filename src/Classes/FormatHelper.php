<?php

namespace App\Classes;

class FormatHelper {
        public $link;
        public $format;

        public function __construct($url) {
                $data = explode('|', $url);
                if(count($data) > 1) {
                        $this->link = $data[0];
                        $this->format = $data[1];
                }
                else {
                        $this->link = $url;
                        $this->format = '';
                }
        }
}


