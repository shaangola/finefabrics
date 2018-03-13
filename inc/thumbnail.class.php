<?php
Class Thumbnail {
	
	public function generateThumbnail ($sourceimagepath,$thumbnailpath,$div_width,$div_height,$img_quality=100) {
		
		$source_img = $this->readImage($sourceimagepath);
		if (!$source_img) {
			
			return false; // Unable to read image so return false
		}
		
		$orig_w = imagesx($source_img);
		$orig_h = imagesy($source_img);
		
		$crop_w = 0;
		$crop_h = 0;
		
		if ($div_width >= $orig_w && $div_height >= $orig_h) { // Image already has dimension to fit with in DIV
			
			$thumb_img = $source_img;   /// Return original image  
			
		} else {
		
		
			$ratio_orig  = $orig_w/$orig_h; // width to height ratio of original image
			$ratio_thumb = $div_width/$div_height; //width to height ratio of thumbnail image
			
			if ($ratio_orig > $ratio_thumb ) {
		
					$crop_w = $div_width;
					$crop_h = round($div_height/$ratio_orig);
						
				}else{
					
					$crop_h = $div_height;
					$crop_w = round($div_height*$ratio_orig);
					
				}
		
			$thumb_img = imagecreatetruecolor($crop_w, $crop_h);
		
			$result = imagecopyresampled($thumb_img, $source_img, 0, 0, 0, 0, $crop_w, $crop_h, $orig_w, $orig_h);
		
			if ($result === false) {
				imagedestroy($thumb_img);
				return false;
			}
		}
		
		$result = $this->saveImage($thumbnailpath, $thumb_img, $img_quality);
		imagedestroy($thumb_img);
		
		if($result) {
			
			return $thumbnailpath;
		}
		else {
			
			return false;
		}
		
		
	}
	
	private function saveImage($imagepath, $image, $quality) {
	
		$ext = strtolower(pathinfo($imagepath, PATHINFO_EXTENSION));
		switch ($ext) {
			case 'jpg': case 'jpeg':
				return imagejpeg($image, $imagepath, $quality);
			case 'gif':
				return imagegif($image, $imagepath);
			case 'png':
				return imagepng($image, $imagepath, 9);
			default:
				return false;
		}
	}
	
	private function readImage ($imagepath) {
		
		$ext = strtolower(pathinfo($imagepath, PATHINFO_EXTENSION));
		switch ($ext) {
			case 'jpg': case 'jpeg':
				return @imagecreatefromjpeg($imagepath);
			case 'gif':
				return @imagecreatefromgif($imagepath);
			case 'png':
				return @imagecreatefrompng($imagepath);
			default:
				return false;
		}
	}
	
}