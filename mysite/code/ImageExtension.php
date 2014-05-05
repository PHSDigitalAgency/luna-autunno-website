<?php
class ImageExtension extends DataExtension{

	private static $width_resize = 768;
	private static $height_resize = 680;

	public function onBeforeWrite(){
		parent::onBeforeWrite();
		if(!$this->owner->ID){
			$resizedWidth = self::$width_resize;
			$resizedHeight = self::$height_resize;

			if($resizedWidth < $this->owner->getWidth() || $resizedHeight < $this->owner->getHeight()){
				$file = Director::baseFolder() . '/' . $this->owner->getFilename();
				$tmpGD = new GD($file);
				$tmpResize = $tmpGD->resizeRatio($resizedWidth,$resizedHeight);
				$tmpResize->writeTo($file);
			}
		}
	}

	public static function setResize($w,$h){
		self::$width_resize = $w;
		self::$height_resize = $h;
	}
}