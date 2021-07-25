<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class ImageUpload extends Model
{
    public static function upload($model, $module, $width = 200, $height = 200)
    {
//        dd($model->imageFile);
        if ($model->imageFile) {
//            dd(1);
            $path = Yii::getAlias('@backend') . "/web/uploads/{$module}/";

            $extension = '.jpg';
            $filename = $path . $model->id;
//dd($filename);
            $model->imageFile->saveAs($filename . $extension);

        } else {
            return false;
        }
    }
}