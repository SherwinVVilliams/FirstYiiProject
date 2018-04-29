<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use app\models\ImageUpload;
use app\models\ArticleTag;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use app\models\Category;
use app\models\Comment;
/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 * @property int $category_id
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function getComment(){
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id' ]);
    }

    public function getTags(){
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('article_tag', ['article_id' => 'id']);//прописуємо звязк багато до багатьох
    }

    public function getSelectedTags(){
        $selectedTags = $this->getTags()->select('id')->asArray()->all();//витягуємо всі айдішніки в виді массиву
          return  ArrayHelper::getColumn($selectedTags, 'id');//хелпер використовуємо тому що на повертається массив массивів а нам потрібен просто массив
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'] , 'required'],
            [['title','description','content'] , 'string'],
            [['title'], 'string' , 'max' => '255'],
            [['date'] , 'date' , 'format' => 'php:Y-m-d'],
            [['date'] , 'default' , 'value' => date('Y-m-d')],// якшо поле пусте то виставлям теперішній час

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function saveCategory($category_id){
     /*   $this->category_id = $category_id;
        return $this->save(false);*/ // можна і так
        $category = Category::findOne($category_id);
        if($category != null)
        {
            $this->link('category', $category);
            return true;
        }
       
    }

    public function saveTags($tags){
        if(is_array($tags)){
            foreach ($tags as $tag_id) {
               $this->clearCurrentTags();
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);//збрігаємо новий тег в бд 
            }
        }
    }

    public function clearCurrentTags(){
        return  ArticleTag::deleteAll(['article_id' => $this->id]);//удаляємо прошлий тег
    }

    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public function saveImage($filename){
        $this->image = $filename;
        return $this->save(false); //зберігаємо і рішаємо чи включати валідацію чи ні зараз вона виключенна бо не пройде валідацію бо інші поля окрім image будуть пусті
    }

    public function getImage(){
       if($this->image){

           return '/web/uploads/'.$this->image;
         }
       return '/web/uploads/no-image.png';
    }//виводимо картінку якшо немає то но-імейдж

    public function deleteImage(){
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete(){
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function getAll($PageSize = 5, $category_id = 0)
    {
        
        $query = Article::CheackCategory_id($category_id);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $PageSize]);
        $article = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $article;
        $data['pagination'] = $pagination;

        return $data;
    }

    private function CheackCategory_id($category_id){
        if($category_id != 0)
            return Article::find()->with('category')->where(['category_id' => $category_id]);
        else
            return Article::find()->with('category');
    }

    public function lengthDescription($length = 250){
        if(strlen($this->description) > $length)
        {
            (int)$i = $length - 3;
            while(strlen($this->description) != $i)
            {
                ++$i;
                if($this->description[$i] == " ")
                {
                    return substr($this->description, 0, $i)." ...";
                }
            }
            return substr($this->description, 0, $length);
        }
        else{
            return $this->description;
        }
    }

    public function getPopular($limit = 3){
        return Article::find()->orderBy('viewed DESC')->limit($limit)->all();
    }

    public function getDateFormate(){
        return Yii::$app->formatter->asDate($this->date);
    }

    public function getRecent($limit = 4){
        return Article::find()->orderBy('date DESC')->limit($limit)->all();
    }

    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        if($this->save())
        {
            return true;
        }
    }

    public function ViewsCounter(){
        ++$this->viewed;
        $this->save(false); 
    }


   
}
