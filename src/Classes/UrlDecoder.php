<?php

namespace App\Classes;

// Receivces and returns a single url
// in decoded form, removes backspaces, etc
class Url_decoder {

        public static function decode($u) {
                if(is_array($u)) {
                        return self::urls($u);
                }
                else
                {
                        return self::url($u);
                }
        }

        private static function _decode($url)
        {
                $remove = ['\\', '"', '}', 'videoUrl:'];
                $url = str_replace($remove, '', $url);
                $url = urldecode($url);
                return $url;
        }

        private  static function url($url) {
                return self::_decode($url); 
        }


        private static function urls($urls) {
            foreach($urls as $url) {
                    $array[] = self::_decode($url);
            }

            // there is nothing to return (no url has been found)
            if(empty($array))
                    return false;

            return $array;
        }
}
