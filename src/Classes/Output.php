<?php

namespace App\Classes;

class Output {

        // $link - real link
        // $urls - extracted urls      
        public static function show($urls, $details = array(), $debug = false)
        {
                // name, views, code, votes, link
                // might be empty regarding the class, failed regex, etc
                extract($details);

                echo $name . '<br>';
                echo $link . '<br>';
                echo 'Views: ' . $views . ' - '; 
                echo 'Up: ' . $votes . '<br>';

                if(empty($code)) {
                        echo '<br>';
                        echo 'Can\'t find any link... maybe it\'s deleted.';
                        echo '<hr>';
                }
                else
                {
                        // Print out urls

                        if(is_array($urls))
                        {
                                foreach($urls as $url)
                                {
                                        self::format($url);
                                }
                        }
                        else
                        {
                                self::format($urls);
                        }

                        if($debug == true) {
                                echo '<br>';
                                echo "<textarea>$code</textarea>";
                        }

                        echo '<br><hr><br/>';
                }

        }

        public static function format($url)
        {
				// get url size
				$FileSize = new File_size();
				$size = $FileSize->curl_get_file_size($url);
				
                echo "<a href='$url'>link ($size)</a> ";
        }
}
