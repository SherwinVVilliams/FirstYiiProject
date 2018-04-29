<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model{

	public $image;

	public function rules(){
		return [
		[['image'] , 'required'],
		[['image'] , 'file' , 'extensions' => 'jpg,png'],
		];
	}

	public function uploadFile(UploadedFile $file, $currentImage){
		
		$this->image = $file;
		if($this->validate()){
		if(file_exists(Yii::getAlias('@web').'uploads/'.$currentImage)){
			$this->deleteCurrentImage($currentImage);//звіряємо удаляємо проглу картінку яка була установленна для цього запису
		}
		
		$filename = $this->generateFileName();//для того щоб коли ми загружаємо картинку з однаковими іменнами їй згенерувалось унікальне імя

		$file->saveAs(Yii::getAlias('@web').'uploads/'.$filename);
		return $filename;
		}
	}

	public function getFolder(){
		return Yii::getAlias('@web').'uploads/'.$currentImage;
	}

	public function generateFileName(){
		return strtolower(md5(uniqid($this->image->baseName)).'.'.$this->image->extension);
	}

	public function deleteCurrentImage($currentImage){
		if(file_exists($this->getFolder().$currentImage)&& !empty($currentImage) && $currentImage != null)
		{
			unlink(Yii::getAlias('@web').'uploads/'.$currentImage);
		}
	}

	public function uploadPhoto(UploadedFile $file, $currentImage){
		
		$this->image = $file;
		if($this->validate()){
		if(file_exists(Yii::getAlias('@web').'uploads/user/'.$currentImage)){
			$this->deleteCurrentPhoto($currentImage);//звіряємо удаляємо проглу картінку яка була установленна для цього запису
		}
		
		$filename = $this->generateFileName();//для того щоб коли ми загружаємо картинку з однаковими іменнами їй згенерувалось унікальне імя

		$file->saveAs(Yii::getAlias('@web').'uploads/user/'.$filename);
		return $filename;
		}
	}

	public function getFolderPhoto(){
		return Yii::getAlias('@web').'uploads/user/'.$currentImage;
	}


	public function deleteCurrentPhoto($currentImage){
		if(file_exists($this->getFolderPhoto().$currentImage)&& !empty($currentImage) && $currentImage != null)
		{
		unlink(Yii::getAlias('@web').'uploads/user/'.$currentImage);
		}
	}

}

 ?>