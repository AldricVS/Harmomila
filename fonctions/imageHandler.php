<?php 
	require_once("libraries/cloudinary/autoload.php");

	\Cloudinary::config(array(
		"cloud_name" => "http-harmomila-alwaysdata-net",
		"api_key" => "394547688259726",
		"api_secret" => "KD5o03NRRWBZvUEJqfrIRMCvhTY",
		"secure" => true
	));

	function uploadImage($imagePath){
		\Cloudinary\Uploader::upload($imagePath);
	}

?>