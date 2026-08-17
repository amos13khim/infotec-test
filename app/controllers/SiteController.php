<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout'],
                'rules' => [
                    ['actions' => ['login'], 'allow' => true, 'roles' => ['?']],
                    ['actions' => ['logout'], 'allow' => true, 'roles' => ['@']],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionReport(): string
    {
        $year = (int) (Yii::$app->request->get('year') ?: date('Y'));

        $rows = Yii::$app->db->createCommand(
            'SELECT a.full_name AS author_name, COUNT(b.id) AS books_count
             FROM author a
             LEFT JOIN book_author ba ON ba.author_id = a.id
             LEFT JOIN book b ON b.id = ba.book_id AND b.year = :year
             GROUP BY a.id, a.full_name
             ORDER BY books_count DESC, a.full_name ASC
             LIMIT 10',
            [':year' => $year],
        )->queryAll();

        $years = Yii::$app->db->createCommand(
            'SELECT DISTINCT year FROM book ORDER BY year DESC'
        )->queryColumn();

        return $this->render('report', [
            'rows' => $rows,
            'selectedYear' => $year,
            'years' => $years,
        ]);
    }
}
