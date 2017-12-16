<?php

namespace App\Classes;

// Download and returns a single url
// @string $url
// @return @string
class Downloader {
        private $page = '';

        public function __construct($url)
        {
                $proxy = '89.236.17.106:3128';
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko");
                // curl_setopt($curl, CURLOPT_PROXY, $proxy);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $this->page = curl_exec($curl);
                curl_close($curl);
        }

        public function get()
        {
                return $this->page;
        }
}
