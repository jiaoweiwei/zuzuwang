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

class LoginController extends Controller{
    //登录并判断
    public function actionLogin(){
        $request=Yii::$app->request->post();
        if($request){
            $username=Yii::$app->request->post('user_name');
            $pwd=Yii::$app->request->post('user_pwd');
            //var_dump($username);
            $query=new Query();
            $arr=$query->select('*')->from('user')->where("user_name='$username'")->one();
            if($arr){
                if($pwd==$arr['user_pwd']){
                    $session=Yii::$app->session;
                    $session->open();   //开启session
                    $session->set('user',$username);        //将用户名存入session
                    $session->set('id',$arr['user_id']);        //将用户名存入session
                    echo "<script>alert('登录成功');location.href='index.php?r=admin/index'</script>";
                }else{
                    echo "<script>alert('您输入的密码有误！');location.href='index.php?r=admin/login'</script>";
                }
            }else{
                echo "<script>alert('您输入的用户名不存在！');location.href='index.php?r=admin/login'</script>";
            }
        }else{
            return $this->render('login');
        }
    }
}