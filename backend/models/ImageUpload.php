<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class ImageUpload extends Model
{
    public static function upload($model, $module)
    {
        if ($model->imageFile) {
            $path = Yii::getAlias('@backend') . "/web/uploads/{$module}/";
            $extension = '.jpg';
            $filename = $path . $model->id;
            $model->imageFile->saveAs($filename . $extension);
        } else {
            return false;
        }
    }
}