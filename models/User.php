<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 * @property string $photo
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['name', 'email', 'password', 'photo'], 'string', 'max' => 255],
            [['name', 'email', 'password'] , 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
       // return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
       // return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
       // return $this->authKey === $authKey;
    }

    public static function findByEmail($email)
    {
        return User::find()->where(['email' => $email])->one();
    }

    public function validatePassword($password)
    {
        if($this->password == $password){
            return true;
        }
        return false;
    }

    public function create(){
        return $this->save(false);
    }

    public function returnUserName($id){
        $user = User::find()->where(['id' => $id])->one();
        return $user->name;
    }

    public function getImage(){
       if($this->photo){

           return '/web/uploads/user/'.$this->photo;
         }
       return '/web/uploads/user/no-image.png';
    }//виводимо картінку якшо немає то но-імейдж

    public function SaveImage($filename){
        $this->photo = $filename;
        $this->save(false);
    }

    /*public function deleteImage(){
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }*/

    public function beforeDelete(){
        $this->deleteImage();
        return parent::beforeDelete();
    }
}
