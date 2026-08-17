<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;

class Subscription extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%subscription}}';
    }

    public function rules(): array
    {
        return [
            [['author_id', 'phone'], 'required'],
            [['author_id'], 'integer'],
            [['phone'], 'string', 'max' => 30],
            [['phone'], 'match', 'pattern' => '/^\+?[0-9\s\-]{6,30}$/'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'author_id' => 'Author',
            'phone' => 'Phone number',
        ];
    }

    public function getAuthor(): ActiveRecord|array|null
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }
}
