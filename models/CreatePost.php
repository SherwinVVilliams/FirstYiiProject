<?php 
namespace app\models;

use yii\web\UploadedFile;

use yii\base\Model;
use app\models\ImageUpload;
use Yii;
class CreatePost extends ImageUpload{
	public $title;
	public $description;
	public $content;
	public $category;
	public $image;

	public function rules(){
		return [
		[['title', 'description', 'content', 'category', 'image'] , 'required'],
		[['image'] , 'file' , 'extensions' => 'jpg,png'],
		[['title'], 'string', 'max' => 100, 'min' => 2],
		[['description'], 'string', 'max' => 500 , 'min' => 3],
		[['content'] , 'string' , 'max' => 10000, 'min' => 3],
		];
	}

	public function attributeLabels(){
		return [
            'title' => 'Заголовок',
            'description' => 'Описание',
            'content' => 'Содержание',
            'date' => 'Дата',
            'image' => 'Картинка',
            'category_id' => 'Категория',
		];
	}

	 public function getInstanceImage($article)
    {
        $file = UploadedFile::getInstance($this, 'image');
        return $this->uploadFile($file, $article->image);
    }

	public function UploadPost(){
		$article = new Article;
		$article->title = $this->title;
		$article->description = $this->description;
		$article->content = $this->content;
		$article->category_id = $this->category;
		$article->image = $this->getInstanceImage($article);
		$article->date = date('Y-m-d');
		$article->viewed = 0;
		$article->status = 0;
		$article->user_id = Yii::$app->user->id;
		
		 if($article->save(false)){
		 	return true;
		}
	}

}
?>
