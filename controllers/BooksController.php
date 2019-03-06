<?php

namespace app\controllers;

use app\models\Books\Authors;
use app\models\Books\Photos;
use app\models\ImageUpload;
use Yii;
use app\models\Books\Books;
use app\models\Books\BooksSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\forms\BooksForm;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BooksForm();
        $model->books = new Books();

        $model->setAttributes(Yii::$app->request->post());
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->books->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new BooksForm();
        $model->books = $this->findModel($id);
        $model->books->index = ArrayHelper::getColumn($model->books->bookAuthor, 'author_id');

        $model->setAttributes(Yii::$app->request->post());
        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->books->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id){

        $model = new ImageUpload;

        if(Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model,'image');

            $url = $model->uploadFile($file);

            $photo = new Photos();
            $photo->url = $url;
            $photo->book_id = $id;
            if($photo->save()){
                return $this->redirect(['view','id'=>$id]);
            }

        }

        return $this->render('image', ['model'=>$model]);
    }
    public function actionDeleteImage($id){
        $image = Photos::findOne($id);
        if($image) {
            $model = new ImageUpload;
            $model->dropFile($image->url);
            $image->delete();
            return $this->redirect(['view','id'=>$image->book_id]);
        }
        return $this->redirect(['index']);
    }
}
