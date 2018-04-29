<?php 

namespace app\components;

use yii\base\Widget;
use app\models\Article;
use app\models\Category;

class CommentsWidget extends Widget{

 	public $comment;
 	public $commentsPagination;
 	public $article_id;

	public function init(){
		parent::init();
	}

	public function run(){

		return $this->render('comments', [
            'comment' => $this->comment,
            'commentsPagination' => $this->commentsPagination,
            'article_id' => $this->article_id,
           ]);
	}


}

?>