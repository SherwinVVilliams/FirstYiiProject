<?php 

namespace app\models;

use yii\base\Model;
use app\models\Comment;
use Yii;
class CommentForm extends Model{

	public $comment;

	public function rules(){
		return [
			[['comment'] , 'required'],
			[['comment'] , 'string' , 'max' => 255, 'min' => 3],
		];
	}

	public function saveComment($article_id)
	{
		$comment = new Comment();
		$comment->user_id = Yii::$app->user->id;
		$comment->article_id = $article_id;
		$comment->text = $this->comment;
		$comment->status = 0;
		$comment->date = date('Y-m-d h:i:s');
		return $comment->save();
	}

}
?>