<?php
namespace common\helpers;

use common\models\User;
use yii\helpers\Html;

class Heart
{
    public static function dateFormat($str_date,$from_format,$to_format)
    {
        $date = \DateTime::createFromFormat($from_format, $str_date);
        return ($date)?$date->format($to_format):'';
    }

    public static function dateTimeFormat($str_datetime,$from_format,$to_format)
    {
        $dateTime = \DateTime::createFromFormat($from_format, $str_datetime);
        return ($dateTime)?$dateTime->format($to_format):'';
    }

    public static function getUser(int $id)
    {
        $user = User::findOne($id);
        return ($user)?$user->username:'-';
    }

    public static function icon($type)
    {
        return Html::tag('i','',['class'=>'fas fa-'.$type.' fa-fw']);
    }

    public static function getUploadPath($target='',$create=1)
    {
        $target = str_replace(['..'],'',$target);
        $path = \Yii::getAlias('@common') .'/../files/'.$target;
        if(!file_exists($path) & $create==1) mkdir($path,0755,true);
        return $path;
    }
}