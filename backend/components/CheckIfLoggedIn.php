<?php
namespace  backend\components;
use Yii;
use yii\base\Behavior;
class  CheckIfLoggedIn extends Behavior
{
    public  function changeLanguage(){
        if (\Yii::$app->getRequest()->getCookies()->has('lang')){
            \Yii::$app->language=\Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }
}
?>