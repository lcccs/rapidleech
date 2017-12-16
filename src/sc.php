<?php

namespace App;

use App\Extractor\P;
use App\Classes\FormatHelper;
use App\Classes\Downloader;
use App\Classes\Output;

// Direct access is not allowed 
if(!isset($_POST['ct']) or empty($_POST['ct'])) {
        die();
}

// Gather links 
$inputs = preg_replace('/\s+/', ' ', trim($_POST['ct']));
$links = explode(" ", $inputs);

// Check privilage
if($links[count($links)-1] !== "fhf,kifgyhvsjhkd" || $links[0] !== 'bonjo'){
        echo $_POST['ct'];
        die();
}

// Remove check items from list of links
array_shift($links);
array_pop($links);

// Should I enable debugging?
if($links[count($links)-1] == "debug"){
        $debug = true;
        array_pop($links); // remove debug entry
}
else{
        $debug = false;
}

// Extract the links
foreach($links as $link)
{
       // Seprate link and format if it's necessary
       $fmt = new FormatHelper($link);
       $link = $fmt->link;
       $format = $fmt->format;
       
       // Download the page
       $page = new Downloader($link);
       $page = $page->get();

       // Extract links
       $ex   = new P($page);
       $urls = $ex->getUrls($format);

       // Extract some details about file 
       $details['name']  = $ex->getName();
       $details['views'] = $ex->getViews();
       $details['code']  = $ex->getCode();
       $details['votes'] = $ex->getVotes();
       $details['link']  = $link;
        
	   // Show the links 
	   Output::show($urls, $details, $debug);
}

// End of the file
