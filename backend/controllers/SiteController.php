<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\widgets\Alert;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionPoll(){
        $this->layout = 'loginLayout';
        $vote = $_REQUEST['vote'];

//get content of textfile
        $filename = "poll_result.txt";
        $array = [7,2];

//put content in array
//        $array = explode("||", $content[0]);
        $yes = $array[0];
        $no = $array[1];

        if ($vote == 0) {
            $yes = $yes + 1;
        }
        if ($vote == 1) {
            $no = $no + 1;
        }
        return $this->render('poll',array('no'=>$no,'yes'=>$yes));
    }
    public function  actionLanguage(){
        if(isset($_POST['lang'])){
            Yii::$app->language=$_POST['lang'];
            $cookie= new yii\web\Cookie(
              [
                  'name'=>'lang',
                  'value'=>$_POST['lang']
              ]
            );
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

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
}
