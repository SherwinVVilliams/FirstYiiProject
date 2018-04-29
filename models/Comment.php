<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $article_id
 * @property int $status
 *
 * @property Article $article
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'article_id' => 'Article ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDateFormate(){
        return Yii::$app->formatter->asDate($this->date);
    }

     public function getArticleComments($PageSize = 3, $article_id)
    {
        $query = Comment::find()->where(['status' => 1, 'article_id' => $article_id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $PageSize]);
        $comments = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['comments'] = $comments;
        $data['pagination'] = $pagination;

        return $data;

    }

     public function getUserComments($PageSize = 3, $user_id)
    {
        $query = Comment::find()->where(['status' => 1, 'user_id' => $user_id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $PageSize]);
        $comments = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['comments'] = $comments;
        $data['pagination'] = $pagination;

        return $data;

    }
}
