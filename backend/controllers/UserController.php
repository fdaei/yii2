<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\AuthItem;
use backend\models\User;
use backend\models\UserSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $authItems=AuthItem::find()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->password_hash= Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
                $model->auth_key=Yii::$app->security->generateRandomString();
                $model->verification_token=Yii::$app->security->generateRandomString() . '_' . time();;
                $model->save(false);
                // add permission
                $listpermission = $_POST['User']['permissions'];
                foreach ($listpermission as $value) {
                    $newpermission = new AuthAssignment;
                    $newpermission->user_id = $model->id;
                    $newpermission->item_name = $value;
                    $newpermission->save();
                }
            }
        }
            return $this->render('create', [
                'model' => $model,
                'authItems'=>$authItems,
                'itemassang'=>null,
            ]);
    }
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $password=$model->password_hash;
        $authItems=AuthItem::find()->all();
        $itemassang = (new \yii\db\Query())->select(['*'])->from('auth_assignment')->where(['user_id' => $id])->all();
        $array=(new \yii\db\Query())->select(['*'])->from('auth_assignment')->where(['user_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            if(password_verify($model->password_hash, $password)){
                $model->save();
            }
            else{
                $model->password_hash= Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
                $model->save();
            }
            // add permission
            $listpermission = $_POST['User']['permissions'];
            $oldpermission=\yii\helpers\ArrayHelper::map($itemassang, 'item_name', 'item_name');
            foreach ($listpermission as $value) {
                if(!in_array($value, $oldpermission)){
                 $newpermission = new AuthAssignment;
                 $newpermission->user_id = $model->id;
                 $newpermission->item_name = $value;
                 $newpermission->save();
                }
            }
//            foreach ($oldpermission as $val){
//                if(!in_array($val, $listpermission)){
//                    AuthAssignment::findModel($val->id)->delete();
//                }
//            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'authItems'=>$authItems,
            'itemassang'=>$itemassang,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
