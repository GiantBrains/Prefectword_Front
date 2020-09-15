<?php

namespace app\controllers;

use Cocur\Slugify\Slugify;
use Yii;
use app\models\Blog;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
               [
                'class' => 'yii\filters\PageCache',
                'only' => ['index', 'create','delete','view','update'],
                'duration' => 1209600,
                'variations' => [
                    \Yii::$app->language,
                    ],
                ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $blogs = Blog::find()->orderBy('id DESC');
        // get the total number of articles (but do not fetch the article data yet)
        $count = $blogs->count();
        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 5;
        // limit the query using the pagination and retrieve the articles
        $articles = $blogs->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'blogs' => $articles,
            'pagination'=>$pagination
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $slug)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('admin')){
            $model = new Blog();
            if ($model->load(Yii::$app->request->post())){
                $slugify = new Slugify();
                $model->slug = $slugify->slugify($model->title);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id, 'slug'=> $model->slug]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $slug)
    {
        if (Yii::$app->user->can('admin')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post())) {
                $slugify = new Slugify();
                $model->slug = $slugify->slugify($model->title);
                $model->save();
                return $this->redirect(['view', 'id' => $id, 'slug'=> $model->slug]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Blog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($slug)
    {
        if (Yii::$app->user->can('admin')){
            $this->findModelBySlug($slug)->delete();

            return $this->redirect(['index']);
        }else{
            return $this->redirect(['index']);
        }
    }

    protected function findModelBySlug($slug)
    {
        if (($model = Blog::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
