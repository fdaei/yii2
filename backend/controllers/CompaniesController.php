<?php

namespace backend\controllers;

use backend\models\Branches;
use backend\models\Companies;
use backend\models\CompaniesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Console;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * CompaniesController implements the CRUD actions for Companies model.
 */
class CompaniesController extends Controller
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
                        'roles' => ['create_branch'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Companies models.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $this->layout = 'loginLayout';
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Companies model.
     * @param int $company_id Company ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($company_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($company_id),
        ]);
    }

    /**
     * Creates a new Companies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can( 'create_company'))
        {
            $model = new Companies();
            $branch= new Branches();
            if ($model->load(Yii::$app->request->post()) && $branch->load(Yii::$app->request->post())) {
                $model->scenario = 'create';
                $model->save();
                $branch->companies_company_id = $model->company_id;
                $branch->save();
                $imageName = $model->company_name;
                if(!empty($model->file)){
                    $model->file = UploadedFile::getInstance($model, 'file');
                    $model->file->saveAs('uploads/' . $imageName . '.' . $model->file->extension);
                    $model->logo = 'uploads/' . $imageName . '.' . $model->file->extension;
                }
                return $this->redirect(['view', 'company_id' => $model->company_id]);
            } else {
                return $this->render('create', array(
                    'model' => $model,
                    'branch'=>$branch,
                ));
            }
        }else{
            throw new  ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Companies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $company_id Company ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($company_id)
    {
        $model = $this->findModel($company_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'company_id' => $model->company_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Companies model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $company_id Company ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($company_id)
    {
        $this->findModel($company_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Companies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $company_id Company ID
     * @return Companies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($company_id)
    {
        if (($model = Companies::findOne(['company_id' => $company_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
