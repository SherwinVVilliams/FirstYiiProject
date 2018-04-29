<?php 

namespace app\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\LoginForm;
use app\models\SignUpForm;
use Yii;

class AuthController extends Controller{

	public function actionSignup()
	{
		$model = new SignUpForm();
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			if($model->signup())
			{
				return $this->redirect(['auth/login']);
			}
		}

		return $this->render("signup", ['model' => $model ]);
	}
	    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

       
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */

  /*  public function actionRole(){
    	$role = Yii::$app->authMaganer->createRole('admin');
    	Yii::$app->authMaganer->add($role);
    	return 1234;
    }*/

}

?>