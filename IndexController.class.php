<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo "ok";
    }
    public function createJson(){
    	$personArray=array(
    		'name'=>'tom',
    		'age'=>18,
    		'job'=>'php',
    		);
    	$personJson=json_encode($personArray);
    	dump($personJson);
    }
    public function readJson(){
    	$personJson='{"name":"tom","age":18,"job":"php"}';
    	$personObj=json_decode($personJson);
    	dump($personObj);
    	echo "<hr/>";
    	$personArray=json_decode($personJson,true);
    	dump($personArray);
    }
    public function createXML(){
    	$str='<?xml version="1.0" encoding="utf-8"?>';
    	$str.='<person>';
    	$str.='<name>tom</name>';
    	$str.='<age>18</age>';
    	$str.='<job>php</job>';
    	$str.='</person>';
    	$rs=file_put_contents('./data.xml',$str);
    	echo $rs;
    }
    public function readXML(){
    	$xmlData=file_get_contents('./data.xml');
    	$objData=simplexml_load_string($xmlData);
    	echo 'name:'.$objData->name.'<br/>';
    	echo 'age:'.$objData->age.'<br/>';
    	echo 'job:'.$objData->job;
    }
    public function testRequest(){
    	$url='http://www.baidu.com';
    	$content=request($url);
    	echo 'this is testRequest'.'<br/>';
    	dump($content);
    }
    public function weather(){
    	$city=I('get.city');
    	$url='http://api.map.baidu.com/telematics/v2/weather?location='.$city.'&ak=B8aced94da0b345579f481a1294c9094';
    	$content=request($url,false);
    	$xmlObj=simplexml_load_string($content);
    	//dump($xmlObj);
    	//object(SimpleXMLElement)#6 (3) { 
    	//["status"] => string(7) "success" 
    	//["currentCity"] => string(6) "商丘" 
    	//["results"] => object(SimpleXMLElement)#7 (1) 
    	//{ ["result"] => array(4) { [0] => object(SimpleXMLElement)#8 (6)
    	// { ["date"] => string(33) "周六 10月29日 (实时：6℃)" 
    	// ["dayPictureUrl"] => string(54) "http://api.map.baidu.com/images/weather/day/duoyun.png" ["nightPictureUrl"] => string(56) "http://api.map.baidu.com/images/weather/night/duoyun.png" 
    	// ["weather"] => string(6) "多云" 
    	// ["wind"] => string(6) "微风" 
    	// ["temperature"] => string(9) "14 ~ 4℃" }
    	echo "城市：".$xmlObj->currentCity."<br/>";
    	echo "日期：".$xmlObj->results->result[0]->date."<br/>";
    	echo "天气：".$xmlObj->results->result[0]->weather."<br/>";
    	echo "风向风力：".$xmlObj->results->result[0]->wind."<br/>";
    	echo "温度：".$xmlObj->results->result[0]->temperature;
    }
    public function getAreaByPhone(){
    	$phone=I('get.phone');
    	$url='http://cx.shouji.360.cn/phonearea.php?number='.$phone;
    	$content=request($url,false);
    	//dump($content);
    	$content=json_decode($content);
    	dump($content);
//     	object(stdClass)#6 (2) {
//   ["code"] => int(0)
//   ["data"] => object(stdClass)#7 (3) {
//     ["province"] => string(6) "河南"
//     ["city"] => string(6) "商丘"
//     ["sp"] => string(6) "电信"
//   }
// }
    	echo '当前号码：'.$phone."<br/>";
    	echo '所属省份：'.$content->data->province."<br/>";
    	echo '所属市区：'.$content->data->city."<br/>";
    	echo '运营商：'.$content->data->sp;

    }
    public function express(){
        $type='yuantong';
        $postid='883185003506903278';
        $url='https://www.kuaidi100.com/query?type='.$type.'&postid='.$postid;
        $content=request($url);
        $content=json_decode($content);
        $data=$content->data;
        foreach($data as $key =>$v){
            echo $v->time.'#######'.$value->context.'<br/>';
        }

    }
}