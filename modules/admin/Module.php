<?php

namespace app\modules\admin;

use yii\filters\AccessControl;
use app\models\User;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = '/admin';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function behaviors()
    {
        return [
            'access' => [
                    'class' => AccessControl::className(),
                    'denyCallback' => function($rule, $action){
                        throw new \yii\web\NotFoundHttpException();
                    },
                
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            if (Yii::$app->user->isGuest) {
                                throw new \yii\web\NotFoundHttpException();
                            }
                            return Yii::$app->user->identity->isAdmin;
                        }
                    ]
                ]
            ],    
         ];
    }

   
}
