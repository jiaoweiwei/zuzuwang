<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;

class AdminController extends CommonController{
    public $layout = 'admin';
    public function actionIndex(){
        return  $this->render('index');
//        echo 123;
    }
}
?>