<?php

namespace App\Extractor;

use \App\Classes\Url_decoder;

// no direct access
if(! defined('APPNAME'))
        die();

class P implements ExtractorInterface {
        private $page;

        public function __construct($page)
        {
                $this->page = $page;
        }

        // Creates a list of urls or only one specific format and returns it
        // @string for specific format (a single url)
        // @array  all available formats (a bunch of urls)
        public function getUrls($format = ''){

               // Search for urls
               // The actual regex ! 
               $pattern = '/videoUrl"?:"?https?.*?("|})/i';
               preg_match_all($pattern, $this->page, $matches);

               // Remove unnecessary stuff from url
               $urls = Url_decoder::decode($matches[0]);

               // Return all of the urls we just found our only the specific requested format 
               $urls = $this->getByFormat($urls, $format);

               return $urls;
        }

        // Retunrs @string or @array
        // If format was = '' then it returns all urls back @array
        // otherwise it will return the only url which matche with the requested format @strign
        private function getByFormat($urls, $format = '') {
               
               // No specific format has been requested for this link (file)
               // return all urls we found
               if(empty($format)) {
                       return $urls;
               }
               else {
                       // only return the url when specefic requested 
                       foreach($urls as $url) {
                            if(stripos($url, $format)) {
                                return $url;
                            }
                       }
              }
        }

        // returns the name
        public function getName() {
            $pattern ='/(?<=title" content=").*(?=">)/';
            preg_match($pattern, $this->page, $matche);
            return $this->returnIfNotEmpty(@$matche[0]);
        }

        // returns the code, for debug
        public function getCode() {
 
               // Get the line which contains the urls and return it for debug purpose
               $pattern = '/var flashvars_[0-9]+.*{.*/i';
               preg_match_all($pattern, $this->page, $matches);
               return $this->returnIfNotEmpty(@$matches[0][0]);
        }

        // returns the number of views
        public function getViews() {
                $pattern = '/(?<=class="count">)[0-9,]+/';
                preg_match_all($pattern, $this->page, $matches);
                return $this->returnIfNotEmpty(@$matches[0][0]);
        }

        // Returns percentage of up votes
        public function getVotes() {
                $pattern = '/(?<=class="percent">)[0-9%]+/';
                preg_match_all($pattern, $this->page, $matches);
                return $this->returnIfNotEmpty(@$matches[0][0]);
        }

        // When returning a value that might be empty (A failed regex)
        // First make sure it's not empty, if  it was return an empty string instead.
        private function returnIfNotEmpty($str) {

                if(! empty($str))
                      return Url_decoder::decode($str);
                else
                        return '';
        }
}


