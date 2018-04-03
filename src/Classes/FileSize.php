<?php

namespace App\Classes;

// Receivces and returns a single url file size
class File_size {

	public function curl_get_file_size( $url ) {
		// Assume failure.
		$result = -1;

		$curl = curl_init( $url );

		// Issue a HEAD request and follow any redirects.
		curl_setopt( $curl, CURLOPT_NOBODY, true );
		curl_setopt( $curl, CURLOPT_HEADER, true );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko' );

		$data = curl_exec( $curl );
		curl_close( $curl );

		if( $data ) {
		$content_length = "unknown";
		$status = "unknown";

		if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
		  $status = (int)$matches[1];
		}

		if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
		  $content_length = (int)$matches[1];
		}

		if( $status == 200 || ($status > 300 && $status <= 308) ) {
		  $result = $content_length;
		}
		}

		$result = $this->humanFileSize($result);
		return $result;

	}

	private function humanFileSize($size,$unit="") {
	  if( (!$unit && $size >= 1<<30) || $unit == "GB")
		return number_format($size/(1<<30),2)."GB";
	  if( (!$unit && $size >= 1<<20) || $unit == "MB")
		return number_format($size/(1<<20),2)."MB";
	  if( (!$unit && $size >= 1<<10) || $unit == "KB")
		return number_format($size/(1<<10),2)."KB";
	  return number_format($size)." bytes";
	}
}
