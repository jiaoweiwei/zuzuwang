﻿<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;
use yii\web\UploadedFile;
use app\Models\House;
use yii\data\Pagination;      //分页


class HouseController extends CommonController
{
    //引入公共样式
    public $layout = 'admin';


	/**
     * 添加【展示首页】
     * @return [type] [description]
     */
    public  function  actionIndex()
    {
    	$request=Yii::$app->request->post();
    	$db=Yii::$app->db;

        //接过来的name;
        $img_name = $_FILES['house_img']['name'];
        //接过来时的路径
        $tmp_name=$_FILES['house_img']['tmp_name'];
        //错误提示
        $error=$_FILES['house_img']['error'];
       if($error == 0)
       {
           //截取后缀
           $sub=substr($img_name,strrpos($img_name,"."));
           //文件名：当前时间+随机数+后缀
           $filename=time().rand(1,9999).$sub;
           //创建文件夹路径
           $path='uploads/'.date('Y') . '/' . date('m') . '/'.date('d').'/';
           //检测文件夹是否存在
           if(file_exists($path)==false){
               if(mkdir($path,0777,true)==false){
                   die("mkdir FAIL");
               }
           }
           //目录：存放图片地址
           $d=$path.$filename;
           if(move_uploaded_file($tmp_name,$d))
           {
               $request['house_img'] = $d;
           }
       }

    	if($request)
    	{
			unset($request['_csrf-frontend']);
	     	$request['add_time'] = date("Y-m-d H:i:s",time());
	     	$res = $db->createCommand()->insert('house',$request)->execute();
	     	if($res)
	     	{
	     		$this->redirect(['show']);
	     	}
    	}
    	else
    	{
    		return  $this->render('index');
    	}	    
    }

    /**
     * 展示列表
     * @return [type] [description]
     */
    public function actionShow()
    {
        //实例化查询类
        $query = new Query();
        //查询出所有的数据
        $houseList = $query->from('house')->where(['is_delete'=>0])->all();
        //统计数据个数
        $count = count($houseList);
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
        $id = Yii::$app->request->get('house_id');
        $res = $db->createCommand()->update('house',['is_delete'=>1],['house_id'=>$id])->execute();
        if($res)
        {
            echo $res;
        }
    }

    /**
     * 修改数据
     * @return [type] [description]
     */
    public function actionUpda()
    {
        
        if($_POST)
        {
            $houseList = Yii::$app->request->post();
            $db = Yii::$app->db;

            //接过来的name;
            $img_name = $_FILES['house_img']['name'];
            //接过来时的路径
            $tmp_name=$_FILES['house_img']['tmp_name'];
            //错误提示
            $error=$_FILES['house_img']['error'];
           if($error == 0)
           {
               //截取后缀
               $sub=substr($img_name,strrpos($img_name,"."));
               //文件名：当前时间+随机数+后缀
               $filename=time().rand(1,9999).$sub;
               //创建文件夹路径
               $path='uploads/'.date('Y') . '/' . date('m') . '/'.date('d').'/';
               //检测文件夹是否存在
               if(file_exists($path)==false){
                   if(mkdir($path,0777,true)==false){
                       die("mkdir FAIL");
                   }
               }
               //目录：存放图片地址
               $d=$path.$filename;
               if(move_uploaded_file($tmp_name,$d))
               {
                   $houseList['house_img'] = $d;
               }
           }
           if($houseList)
           {
                unset($houseList['_csrf-frontend']);
                $houseList['add_time'] = date("Y-m-d H:i:s",time());
                $res = $db->createCommand()->update('house',$houseList,['house_id'=>$houseList['house_id']])->execute();
                if($res)
                {
                    $this->redirect(['show']);
                }
           }
        }
        else
        {
            $id = Yii::$app->request->get('house_id');
            $model=new House();
            $houseInfo=$model->find()->asArray()->where("house_id=$id")->one();
            return $this->render('upda',['houseInfo'=>$houseInfo]);
        }      
    }

    /**
     * 修改显示状态
     * @return [type] [description]
     */
    public function actionUpsale()
    {
        $data = Yii::$app->request->get();
        unset($data['r']);
        $db = Yii::$app->db;
        $res = $db->createCommand()->update('house',$data,['house_id'=>$data['house_id']])->execute();
        if($res)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    /**
     * 批量删除
     * @return [type] [description]
     */
    public function actionDelall()
    {   
        $ids = trim(Yii::$app->request->get('id'),",");
        $db = Yii::$app->db;
        $res = $db->createCommand("UPDATE house SET is_delete = 1 WHERE house_id IN (".$ids.")")->execute();
        if($res)
        {
            echo $res;
        }
    }
}
?>