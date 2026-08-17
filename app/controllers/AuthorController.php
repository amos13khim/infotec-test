<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Author;
use app\models\Subscription;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AuthorController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $query = Author::find()->orderBy(['full_name' => SORT_ASC]);
        $count = clone $query;
        $pages = new Pagination(['totalCount' => $count->count()]);

        $authors = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['authors' => $authors, 'pagination' => $pages]);
    }

    public function actionView(int $id): string
    {
        $model = $this->findModel($id);

        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate(): Response|string
    {
        $model = new Author();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Author created.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Author updated.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Author deleted.');
        return $this->redirect(['author/index']);
    }

    public function actionSubscribe(int $id): Response|string
    {
        $author = $this->findModel($id);
        $subscription = new Subscription();
        $subscription->author_id = $author->id;

        if ($this->request->isPost && $subscription->load($this->request->post())) {
            if ($subscription->save()) {
                Yii::$app->session->setFlash('success', 'You are subscribed to this author.');
                return $this->redirect(['author/view', 'id' => $author->id]);
            }
        }

        return $this->render('subscribe', ['author' => $author, 'model' => $subscription]);
    }

    protected function findModel(int $id): Author
    {
        if (($model = Author::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested author does not exist.');
    }
}
