<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Book;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class BookController extends Controller
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
        $query = Book::find()->orderBy(['year' => SORT_DESC, 'title' => SORT_ASC]);
        $count = clone $query;
        $pages = new Pagination(['totalCount' => $count->count()]);

        $books = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['books' => $books, 'pagination' => $pages]);
    }

    public function actionView(int $id): string
    {
        $book = $this->findModel($id);
        return $this->render('view', ['model' => $book]);
    }

    public function actionCreate(): Response|string
    {
        $model = new Book();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->cover_path = $this->uploadCover();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Book created.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $uploaded = $this->uploadCover();
            if ($uploaded) {
                $model->cover_path = $uploaded;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Book updated.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Book deleted.');
        return $this->redirect(['book/index']);
    }

    protected function findModel(int $id): Book
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested book does not exist.');
    }

    protected function uploadCover(): ?string
    {
        $file = UploadedFile::getInstanceByName('Book[cover_path]');
        if ($file === null || !$file->name) {
            return null;
        }

        $dir = Yii::getAlias('@webroot/uploads/covers');
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $name = StringHelper::basename($file->name);
        $hash = Yii::$app->security->generateRandomString(8);
        $path = $dir . DIRECTORY_SEPARATOR . $hash . '_' . $name;
        if ($file->saveAs($path)) {
            return '/uploads/covers/' . $hash . '_' . $name;
        }

        return null;
    }
}
