<?php 

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\Comment;


class CommentController extends Controller{

	public function actionIndex(){
		$comment = Comment::find()->orderBy('id desc')->all();
		return $this->render('index', ['comment' => $comment]);
	}


	public function actionDelete($id){
		$comment = Comment::find()->where(['id' => $id])->one();
		if($comment->delete()){
		
			return $this->redirect(['comment/index']);
		}
	}

	public function actionAccess($id)
	{
		$comment = Comment::find()->where(['id' => $id])->one();
		if($comment->status == 0)
		{
			$comment->status = 1;
			$comment->save(false);
		}
		else
		{
			$comment->status = 0;
			$comment->save(false);
		}
		return $this->redirect(['comment/index']);
	}
}
?>
