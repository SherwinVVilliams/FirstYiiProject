<?php 

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignUpForm extends Model{

	public $name;
	public $email;
	public $password;
	public $repeatPassword;

	public function rules()
	{
		return [
		[['name', 'email', 'password', 'repeatPassword'], 'required'],
		[['name', 'email', 'password', 'repeatPassword'], 'string', 'max' => 250, 'min' => 3],
		[['email'], 'email'],
		[['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
		[['password'], 'validatePassword', 'message' => 'Пароли должны совпадать'],
		];
	}

	public function AttributeLabels()
	{
		return [
		'name' => 'Name',
		'email' => 'Email',
		'password' => 'Password',
		'repeatPassword' => 'Repeat Password',
		];
	}

	public function signup(){
		if(!$this->validatePassword())
		{
			$this->addError('repeatPassword',"Пароли должны совпадать");
			return false;
		}
		else
		{
			if($this->validate())
			{
				$user = new User;
				$user->name = $this->name;
				$user->email = $this->email;
				$user->password = $this->password;
				$user->create();
				return true;
			}
		}
		return false;
	}

	public function validatePassword()
	{
		return $this->password == $this->repeatPassword;
	}

}

?>