<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\User;
use app\models\CommentForm;
use app\models\Comment;
use app\models\CreatePost;
use app\models\ImageUpload;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','post','profile'],
                'rules' => [
                    [
                        'actions' => ['logout','post','profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $data = Article::getAll(2);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $category = Category::getBar();

        return $this->render('index', [
            'article' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'category' => $category,
            ]);
    }

    public function actionCategory($id)
    {
        $data = Article::getAll(3, $id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $categoryBar = Category::getBar();

        return $this->render('category', [
            'article' => $data['articles'],
            'pagination' => $data['pagination'],
            'popular' => $popular,
            'recent' => $recent,
            'categoryList' => $categoryList,
            'categoryBar' => $categoryBar,
            ]);
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionSingle($id)
    {
        $CountOfComments = 3; 
        $article = Article::findOne($id);
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        $data = Comment::getArticleComments($CountOfComments ,$article->id);
        $commentForm = new CommentForm;
        $category = Category::getBar();

        $article->ViewsCounter();
        return $this->render('single', [
            'article' => $article,
            'popular' => $popular,
            'recent' => $recent,
            'category' => $category,
            'comment' => $data['comments'],
            'commentsPagination' => $data['pagination'],
            'commentForm' => $commentForm,
            'user_is_Guest' => Yii::$app->user->isGuest,
            ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm;

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment','Ваш коментарий отправлен и ждет одобрения админа');
                return $this->redirect(['site/single', 'id' => $id]);
            }
        }
    }

    public function actionUserInfo($id){

        return $this->render('userinfo');
    }

    public function actionPost(){
        $model = new CreatePost();
        $category = Category::find()->all();
        if(Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            if($model->UploadPost())
            {
                Yii::$app->getSession()->setFlash('uploadPost', 'Ваш пост создан и отправлен администратору для одобрения');
                return $this->redirect(['site/post']);
            }
        }
        return $this->render('post', ['model' => $model, 'category' => $category]);

    }

    public function actionDelete($id)
    {
        $article = Article::find()->where(['id' => $id])->one();
        $article->delete();
        return $this->redirect(['site/profile']);
    }

    public function actionCategoryList(){
        $categories = Category::find()->all();
        $category = Category::getBar();
        $popular = Article::getPopular();
        $recent = Article::getRecent();
        return $this->render('categorylist', [
            'category' => $categories,
            'popular' => $popular,
            'recent' => $recent,
            'category' => $category,
             ]);
    }

    public function actionProfile(){
        $CountOfComments = 3;
        $article = Article::find()->with('category')->where(['user_id' => Yii::$app->user->id])->all();
        $user = User::find()->where(['id'=> Yii::$app->user->id])->one();
        $data = Comment::getUserComments($CountOfComments ,Yii::$app->user->id);

        $imageUpload = new ImageUpload;
        if(Yii::$app->request->isPost){

         $file = UploadedFile::getInstance($imageUpload, 'image');

         if($user->saveImage($imageUpload->uploadPhoto($file ,$user->photo)))
         {
            return $this->redirect(['profile']);
         }
        }
        return $this->render('profile', [
            'article' => $article,
            'user' => $user,
            'comment' => $data['comments'],
            'commentsPagination' => $data['pagination'],
            'imageUpload' => $imageUpload,
            ]);
    }

    public function actionCommentDelete($id){
        $comment = Comment::find()->where(['id' => $id])->one();
        $comment->delete();
        return $this->redirect(['site/profile']);
    }

}
