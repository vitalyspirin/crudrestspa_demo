<?php

namespace app\models;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $user_email
 * @property string $user_firstname
 * @property string $user_lastname
 * @property string $user_passwordhash
 * @property string $user_accesstoken
 * @property string $user_role
 * @property double $user_expectedcalories
 * @property Calories[] $calories
 */
class UserYii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_email', 'user_firstname', 'user_lastname', 'user_passwordhash', 'user_accesstoken'], 'required'],
            [['user_role'], 'string'],
            [['user_expectedcalories'], 'number'],
            [['user_email', 'user_firstname', 'user_lastname', 'user_passwordhash', 'user_accesstoken'], 'string', 'max' => 255],
            [['user_email'], 'unique'],
            [['user_accesstoken'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_email' => 'User Email',
            'user_firstname' => 'User Firstname',
            'user_lastname' => 'User Lastname',
            'user_passwordhash' => 'User Passwordhash',
            'user_accesstoken' => 'User Accesstoken',
            'user_role' => 'User Role',
            'user_expectedcalories' => 'User Expectedcalories',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalories()
    {
        return $this->hasMany(Calories::className(), ['user_id' => 'user_id']);
    }
}
