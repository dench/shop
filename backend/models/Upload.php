<?php

namespace backend\models;

use Yii;

// TODO: getLink() пришлось вынести в отдельный класс backend\models

class Upload extends \common\models\Upload
{
    /**
     * @return string
     */
    public function getLink()
    {
        return Yii::$app->urlManagerFrontend->createAbsoluteUrl(['file/open', 'dir' => $this->dir, 'name' => $this->name]);
    }
}