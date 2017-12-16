<?php

namespace App\Extractor;

// All extractor should implement this interface
interface ExtractorInterface{

        // getUrls method should return an @array of all available urls
        // or a @string if a specific format has been chossen (a single url)
        public function getUrls();
        
        // --------------------------------------------------------------
        // -- These all should exist, howerver thay can return nothing --
        // --------------------------------------------------------------
        
        
        // Should return a @string - name of file
        public function getName();
        
        // Should return a @string - including all lines contaning the urls
        // If debug is enabled it will be showed to user
        public function getCode();
         
        // @string like 98,91
        public function getViews();
        
        // @string like 100, 30%
        public function getVotes();

}
