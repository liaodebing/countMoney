<?php

/**

* Created by PhpStorm.

* User: liaodebing

* Date: 2016/12/3

* Time: 16:33

*/

error_reporting( E_ALL&~E_NOTICE );

$feng = $_POST['feng'];

$jian = $_POST['jian'];

$long = $_POST['long'];

$bin = $_POST['bin'];

$avg = ($feng+$jian+$long+$bin)/4;

$feng1 = $feng - $avg;

$jian1 = $jian - $avg;

$long1 = $long - $avg;

$bin1 = $bin - $avg;

$arr = array('zhaixiaofeng'=>$feng1,'zengxiujian'=>$jian1,'wangweilong'=>$long1,'wanghongbin'=>$bin1);

$arr1 = array($feng1,$jian1,$long1,$bin1);

asort($arr);

sort($arr1);

//print_r($arr);

//print_r($arr1);

compute($arr,$arr1);

function compute($arr,$arr1)

{

    $leng1 = count($arr1)-1;

//    echo $leng1;

    if(($arr1[0]+$arr1[$leng1])>=0)

    {

        echo array_search("$arr1[0]",$arr).' 给 '.array_search("$arr1[$leng1]",$arr).' '.abs($arr1[0]).'<br/>';//出钱最少的人账清了

        unset($arr[$arr1[0]]);//数组arr删除出钱最少的人

//        print_r($arr);

        $arr[$arr[$arr1[$leng1]]] = $arr1[0]+$arr1[$leng1];//把出钱最多的人的钱重新计算一下；

        asort($arr);

        unset($arr1[0]);

        $arr1[$leng1] = $arr1[0]+$arr1[$leng1];

        sort($arr1);

//        print_r($arr);

//        print_r($arr1);

    }

    else{

//        echo $arr1[$leng1];

        echo array_search("$arr1[0]",$arr).' 给 '.array_search("$arr1[$leng1]",$arr).' '.$arr1[$leng1].'<br/>';//出钱最多的人账清了

        unset($arr[$arr1[$leng1]]);//数组arr删除出钱最多的人

        $arr[$arr[$arr1[0]]] = $arr1[0]+$arr1[$leng1];//把出钱最少的人的钱重新计算一下；

        asort($arr);

        unset($arr1[$leng1]);

        $arr1[0] = $arr1[0]+$arr1[$leng1];

        sort($arr1);

//        print_r($arr);

//        print_r($arr1);

    }

    //设置跳出递归的条件

    if(count($arr1)<2)

    {

        return 'sussess';

    }

    compute($arr,$arr1);//递归调用方法

}
