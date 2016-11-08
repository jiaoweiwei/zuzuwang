<?php
namespace frontend\controllers;
use Yii;
use yii\web\controller;
//use frontend\models\ListtModel;

class AdminController extends Controller{
	// //引入公共样式
 //    public $layout = 'admin';
    
    public  function  actionIndex()
    {
      return  $this->render('index');
    }


}
?>