<?php 

namespace app\components;

use yii\base\Widget;
use app\models\Article;
use app\models\Category;

class SidebarWidget extends Widget{

	public $popular;
	public $recent;
	public $category;

	public function init(){
		parent::init();
		if($this->popular === null | $this->recent === null | $this->category === null){
       		$populars = Article::getPopular();
        	$recents = Article::getRecent();
        	$categories = Category::getBar();
        	$this->getData($populars, $recents , $categories );
		}
	}

	public function run(){

		//return var_dump($this->$popular);die;
		return $this->render('sidebar', [
            'popular' => $this->popular,
            'recent' => $this->recent,
            'category' => $this->category,
           ]);
	}

	private function getData( $populars, $recents , $categories){
		$this->popular = $populars;
		$this->recent = $recents;
		$this->category = $categories;
	}

}

?>