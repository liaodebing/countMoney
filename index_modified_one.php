<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>记账本</title>

</head>

<body>

    <div>

        <form id="form1" method="post" action="index.php">

            zhaixiaofeng：<input type="text" name="feng" id="f"><br/>

            zengxiujian：<input type="text" name="jian" id="j"><br/>

            wangweilong：<input type="text" name="long" id="l"><br/>

            wanghongbin：<input type="text" name="bin" id="b"><br/>

            <input id="sub" type="submit" value="计算"><br/>

        </form>

    </div>

    <div>

<?php

/**

 * Created by PhpStorm.

 * User: 兵兵

 * Date: 2016/12/12

 * Time: 8:53

 */

error_reporting( E_ALL&~E_NOTICE );

$feng = $_REQUEST['feng'];     //接收页面传过来的数值

$jian = $_POST['jian'];

$long = $_POST['long'];

$bin = $_POST['bin'];

$avg = ($feng+$jian+$long+$bin)/4;  //计算平均值

$feng1 = $feng - $avg;      //计算每个人应该补多少钱，负数表示还应该出钱，正数表示应该收前

$jian1 = $jian - $avg;

$long1 = $long - $avg;

$bin1 = $bin - $avg;

$arr = array('zhaixiaofeng'=>$feng1,'zengxiujia'=>$jian1,'wangweilong'=>$long1,'wanghongbin'=>$bin1);

$arr1 = array($feng1,$jian1,$long1,$bin1);

asort($arr);    //按照每个人的差值进行从低到高排序，键值对的索引关系不变

sort($arr1);    //将差值进行从低到高排序

compute($arr,$arr1);

function compute($arr,$arr1)

{

    $leng1 = count($arr1)-1;    //计算后一个数组的下标

    //出钱最少的人需要补交的钱正好等于出钱最多的人需要回收的钱

    if(($arr1[0]+$arr1[$leng1]) == 0)

    {

        ?>

        <p>

            <?php

            echo array_search("$arr1[0]",$arr).' 给 '.array_search("$arr1[$leng1]",$arr).' '.abs($arr1[0]).'<br/>';

            ?>

        </p>

        <?php

        unset($arr[array_search("$arr1[0]",$arr)]);         //数组arr删除出钱最少的人

        unset($arr[array_search("$arr1[$leng1]",$arr)]);    //数组arr删除出钱最多的人

        unset($arr1[0]);

        unset($arr1[$leng1]);

        sort($arr1);

    }

    //出钱最少的人把需要补交的钱全部补给出钱最多的人

    else if(($arr1[0]+$arr1[$leng1])>0)

    {

        ?>

        <p>

            <?php

            echo array_search("$arr1[0]",$arr).' 给 '.array_search("$arr1[$leng1]",$arr).' '.abs($arr1[0]).'<br/>';

            ?>

        </p>

        <?php

        unset($arr[array_search("$arr1[0]",$arr)]);//数组arr删除出钱最少的人

        $arr[array_search("$arr1[$leng1]",$arr)] = $arr1[0]+$arr1[$leng1];//把出钱最多的人的钱重新计算一下；

        asort($arr);    //重新排序

        $arr1[$leng1] = $arr1[0]+$arr1[$leng1];

        unset($arr1[0]);

        sort($arr1);

    }

    else

    {

        ?>

        <p>

            <?php

            echo array_search("$arr1[0]",$arr).' 给 '.array_search("$arr1[$leng1]",$arr).' '.$arr1[$leng1].'<br/>';

            ?>

        </p>

        <?php

        unset($arr[array_search("$arr1[$leng1]",$arr)]);//数组arr删除出钱最多的人

        $arr[array_search("$arr1[0]",$arr)] = $arr1[0]+$arr1[$leng1];//把出钱最少的人的钱重新计算一下；

        asort($arr);

        $arr1[0] = $arr1[0]+$arr1[$leng1];

        unset($arr1[$leng1]);

        sort($arr1);

    }

    //设置跳出递归的条件

    if(count($arr1)<2)

    {

//        echo 'compute finished';

        return ;

    }

    compute($arr,$arr1);//递归调用方法

}

?>

    </div>

</body>

</html>
