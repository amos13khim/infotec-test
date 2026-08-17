<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Book extends ActiveRecord
{
    public ?array $authorIds = [];

    public static function tableName(): string
    {
        return '{{%book}}';
    }

    public function rules(): array
    {
        return [
            [['title', 'year', 'isbn'], 'required'],
            [['title', 'isbn', 'cover_path'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['year'], 'integer', 'min' => 1900, 'max' => 2100],
            [['authorIds'], 'each', 'rule' => ['integer']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Title',
            'year' => 'Year',
            'description' => 'Description',
            'isbn' => 'ISBN',
            'cover_path' => 'Cover image',
            'authorIds' => 'Authors',
        ];
    }

    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('{{%book_author}}', ['book_id' => 'id'])
            ->orderBy(['full_name' => SORT_ASC]);
    }



    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        BookAuthor::deleteAll(['book_id' => $this->id]);
        foreach ((array) $this->authorIds as $authorId) {
            if ((int) $authorId <= 0) {
                continue;
            }
            $link = new BookAuthor();
            $link->book_id = (int) $this->id;
            $link->author_id = (int) $authorId;
            $link->save();
        }

        if ($insert) {
            $this->sendNewBookNotifications();
        }
    }

    public function beforeDelete(): bool
    {
        BookAuthor::deleteAll(['book_id' => $this->id]);
        return parent::beforeDelete();
    }

    private function sendNewBookNotifications(): void
    {
        foreach ($this->authors as $author) {
            $subscriptions = Subscription::find()->where(['author_id' => $author->id])->all();
            foreach ($subscriptions as $subscription) {
                SmsService::sendToPhone(
                    $subscription->phone,
                    sprintf(
                        'New book available: %s by %s. Visit Books Catalog.',
                        $this->title,
                        $author->full_name,
                    ),
                );
            }
        }
    }
}
