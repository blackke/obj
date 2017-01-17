<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //分类添加
    public function getAdd(){
    	//获取格式化类别数据
    	$cate= self::getCates();
    	return view('cate.add',['list'=>$cate]);
    }

    //获取格式化类别数据
    public static function getCates(){
    	//select *,concat(path,id) as paths from cate order by paths
    	// $cate=DB::table('cate')->get();
    	$cate=DB::table('cate')->select('*',DB::raw('concat(path,id) as paths'))->orderBy('paths')->get();//select 指定字段
    	//dd($cate);
    	//修改类别的样式 
    	foreach($cate as $k=>$v){
    		//分配的级别  0 顶级
    		$num=(count(explode(',',$v['path']))-2);
    		$cate[$k]['cate']=str_repeat('☆',$num).$v['cate'];
    		// echo (count(explode(',',$v['path']))-2).'---'.$v['cate'].'<br>';
    	}
    	dd();
    	return $cate;
    }
}
