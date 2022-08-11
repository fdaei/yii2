<?php

namespace backend\controllers;

use backend\models\Model;
use backend\models\Po;
use backend\models\PoItem;
use backend\models\PoSearch;
use PHPUnit\Util\Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
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
     * Lists all Po models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Po model.
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
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Po();
        $modelsPoItem = [new PoItem];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $modelsPoItem = Model::createMultiple(PoItem::classname());
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPoItem as $modelsPoItem) {
                            $modelsPoItem->po_id = $model->id;
                            if (! ($flag = $modelsPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelsPoItem' => (empty($modelsPoItem)) ? [new PoItem] : $modelsPoItem
        ]);
    }

    /**
     * Updates an existing Po model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsPoItem = PoItem::find()->where(['po_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {
            // $model->save();
            $oldIDs = ArrayHelper::map($modelsPoItem, 'id', 'id');
            $modelsPoItem = Model::createMultiple(PoItem::classname(), $modelsPoItem);
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPoItem, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            PoItem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPoItem as $modelPoItem) {
                            $modelPoItem->po_id = $model->id;
                            if (!($flag = $modelPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model, 'modelsPoItem' => $modelsPoItem]);
        }
    }

    /**
     * Deletes an existing Po model.
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
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
