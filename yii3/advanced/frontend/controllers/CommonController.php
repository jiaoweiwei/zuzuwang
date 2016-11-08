<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\db\Query;
//use frontend\models\ListtModel;

class CommonController extends Controller{

    public function beforeAction($action){
        $session=\Yii::$app->session;
        $user_session=$session->get('user');
        //判断是否有登录session
        if(!isset($user_session)){
            echo "<script>alert('请先登录');location.href='index.php?r=login/login'</script>";
        }
        //判断权限
        $ctl=Yii::$app->controller->id;     //获取当前访问的控制器
        //var_dump($ctl);die;
        $action=Yii::$app->controller->action->id;     //获取当前访问的方法
        //var_dump($action);
        //$requestPath=  strtolower($ctl. '/' .$action);     //拼接处用户访问的路径
        //var_dump($requestPath);
        //当访问后台是首页权限是公共的
        if($ctl=="admin" && $action=="index"){
            return true;
        }
        $id_session=$session->get('id');       //接到用户登录时存的id
        //var_dump($id_session);die;
        $sql="select  rn.node_id,n.controller,n.action  from role_node as rn left join node as n on  rn.node_id=n.node_id where role_id in(SELECT role_id from  user_role where user_id=$id_session) group by rn.node_id";
        $rows=Yii::$app->db->createCommand($sql)->queryAll();    //查询出该角色的权限
        //var_dump($rows);die;
        if($rows){
            foreach($rows as $key => $val){
                if($val['controller']==$ctl && $val['action']==$action){
                    return true;
                }
            }
        }else{
            echo "<script>alert('抱歉，您的权限不够');location.href='index.php?r=login/login'</script>";
        }
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }

}