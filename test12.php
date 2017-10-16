<?php

/**
 * @param $arr
 */
function mp($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

}

/* Задание test1
 **********************************************************************************************************************/

/**
 * @param $x
 * @param $res
 * @return mixed
 */
function recursion($x, $res)
{
    return ($key = array_shift($x)) ? recursion($x, [$key => $res]) : $res;
}

$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

echo "<h1>Результат выполнения test1</h1>";
mp(recursion($x, null));


/* Задание test2
 **********************************************************************************************************************/

/**
 * @param $res
 * @param $x
 * @return mixed
 */
function recursion2($res, $x )
{
    return ($key = array_pop($x)) ? recursion2([$key => $res], $x) : $res;
}

/**
 * @param $array
 * @return array
 */
function transformation1 ( $array )
{
    $result = [];
    array_walk($array, function ($val, $key) use (&$result) {
        $result = array_merge_recursive(recursion2($val, explode(".", $key)), $result);
    });

    return $result;
}

/**
 * @param $res
 * @param $key
 * @param $resultArray
 */
function recursion3( $res, $key, &$resultArray )
{
    if (is_array($res)) {
        foreach ($res as $k => $v) {
            recursion3($v, ($key ? $key . "." : "") . $k, $resultArray);
        }
    } else {
        $resultArray[$key] = $res;
    }

}

/**
 * @param $array
 * @return array
 */
function transformation2( $array )
{
    $result = [];
    recursion3($array, "", $result);

    return $result;

}

$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

echo "<h1>Результат выполнения test2</h1>";
/*Преобразование в многомерный массив массива data1*/
mp(transformation1($data1));
/*Обратное преобразование из многомерного массива*/
mp(transformation2(transformation1($data1)));


?>
