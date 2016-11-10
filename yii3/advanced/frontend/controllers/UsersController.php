<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use yii\data\Pagination;
class UsersController extends CommonController{
    public $layout = 'admin';

    /**显示页面
     * @return void
     */
    public function actionShow(){
        $query = new Query();
        //查询出所有的数据
        $userList = $query->from('user')->where(['is_delete'=>0])->all();
        //统计数据个数
        $count = count($userList);
        //实例化分页类
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->setPageSize(2 );
        $data = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('show', ['data' => $data, 'pagination' => $pagination,]);
    }
    /**
     * 删除
     * @return [type] [description]
     */
    public function actionDel()
    {
        $db = Yii::$app->db;
        $id = Yii::$app->request->get('user_id');
//        echo $id;exit;
        $res = $db->createCommand()->update('user',['is_delete'=>1],['user_id'=>$id])->execute();
        if($res)
        {
            echo "<script>alert('删除成功');location.href='index.php?r=users/show'</script>";
        }else{
            echo "<script>alert('删除失败');location.href='index.php?r=users/show'</script>";
       }
    }

    /**
     *
     */
    public function actionAdd(){
        $request = YII::$app->request;
        if($request->isPost) {
//            print_r( $request->post());exit;
            $user_name = $request->post('user_name');
            $user_pwd = $request->post('user_pwd');
            $user_time=date("Y-m-d H:i:s",time());
            $res=Yii::$app->db->createCommand()->insert('user', ['user_name' => $user_name,'user_pwd'=>$user_pwd,'user_time'=>$user_time])->execute();
            if($res){
                echo "<script>alert('添加成功');location.href='index.php?r=users/show'</script>";
            }else{
                echo "<script>alert('添加失败');location.href='index.php?r=users/show'</script>";
            }
        }else{
            return $this->render('add');
        }

    }
    /**
     * 修改数据
     * @return [type] [description]
     */
    public function actionUpda()
    {
        $request = YII::$app->request;
        if($request->isPost){
//            print_r( $request->post());exit;
            $user_name=$request->post('user_name');
            $user_pwd=$request->post('user_pwd');
            $user_id=$request->post('user_id');
            $res=Yii::$app->db->createCommand()->update('user', ['user_name' => $user_name,'user_pwd'=>$user_pwd], "user_id = $user_id")->execute();
            if($res){
                echo "<script>alert('修改成功');location.href='index.php?r=users/show'</script>";
            }else{
                echo "<script>alert('修改失败');location.href='index.php?r=users/show'</script>";
            }
        }
        if($request->get('user_id')){
            $id=$request->get('user_id');
            $data = Yii::$app->db->createCommand("SELECT * FROM user WHERE user_id=$id")->queryOne();
            return $this->render('upda', ['userInfo' => $data]);
        }
    }


    public function actionAuthority(){
        $request = YII::$app->request;
        $db = Yii::$app->db;
        if($request->isPost){
            $request->post();
            $role_ids= $request->post('role_id');
            $user_id= $request->post('user_id');
            //查询派生表中数据
            $sql="select * from user_role where user_id=$user_id";
            $user_role=Yii::$app->db->createCommand($sql)->queryAll();

            if($user_role){
                //删除派生表中原有数据
                $re=Yii::$app->db->createCommand()->delete('user_role', "user_id = $user_id")->execute();
                //判断是否接到值
                if($role_ids){
                    foreach($role_ids as $v){
                        $res=Yii::$app->db->createCommand()->insert('user_role', ['user_id' => $user_id,'role_id'=>$v])->execute();
                    }
                    if($res){
                        echo "<script>alert('角色赋权成功');location.href='index.php?r=users/show'</script>";die;
                    }else{
                        echo "<script>alert('角色赋权失败');location.href='index.php?r=users/show'</script>";die;
                    }
                }else{
                    echo "<script>alert('清除所有角色');location.href='index.php?r=users/show'</script>";die;
                }
            }else{
                if($role_ids){
                    foreach($role_ids as $v){
                        $res=Yii::$app->db->createCommand()->insert('user_role', ['user_id' => $user_id,'role_id'=>$v])->execute();
                    }
                    if($res){
                        echo "<script>alert('角色赋权成功');location.href='index.php?r=users/show'</script>";die;
                    }else{
                        echo "<script>alert('角色赋权失败');location.href='index.php?r=users/show'</script>";die;
                    }
                }else{
                    echo "<script>alert('清除所有角色');location.href='index.php?r=users/show'</script>";die;
                }
            }

        }
        if($request->isGet){
            //查询角色表
            $query = new Query();
            //查询出所有的数据
            $roleList = $query->from('role')->where(['is_delete'=>0])->all();
            $user_id = Yii::$app->request->get('user_id');
            //查询用户拥有角色
            $sql="select * from user_role where user_id=$user_id";
            $user_role=Yii::$app->db->createCommand($sql)->queryAll();
//            print_r($user_role);exit;
            $arr=array();
            foreach($user_role as $v){
                $arr[]=$v['role_id'];
            }
//            print_r($arr);exit;
            foreach($roleList as $k=>$val){
                if(in_array($val['role_id'],$arr)){
                    $roleList[$k]['check']="check";
                }else{
                    $roleList[$k]["check"]="false";
                }
            }

            return $this->render('authority',['roleList'=>$roleList,'user_id'=>$user_id,'user_role'=>$user_role]);
//            echo $id;exit;
        }


    }
}