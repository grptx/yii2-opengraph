<?php
namespace grptx\opengraph;
use Yii;

class TwitterCard {
	public $card;
	public $site;
	public $site_id;
	public $creator;
	public $creator_id;
	public $title;
	public $description;
    public $image;

	public function __construct(){
		// Load default values
		$this->card = null;
		$this->site = null;
		$this->site_id = null;
		$this->creator = null;
		$this->creator_id = null;
	}
	
	public function set($metas=[]){
		// Massive assignment by array
		foreach($metas as $property=>$content){
			if(property_exists($this, $property)){
				$this->$property = $content;
			}
		}
	}
	
	public function registerTags(){
		$this->checkTag('card');
		$this->checkTag('site');
		$this->checkTag('site_id');
		$this->checkTag('creator');
		$this->checkTag('creator_id');
        $this->checkTag('title');
        $this->checkTag('description');
        $this->checkTag('image');
	}
	
	private function checkTag($property){
		if($this->$property!==null){
			$property = str_replace('_', ':', $property);
			Yii::$app->controller->view->registerMetaTag([
				'property' => 'twitter:'.$property,
				'content' => $this->$property,
			], 'twitter:'.$property);
		}
	}
	
}