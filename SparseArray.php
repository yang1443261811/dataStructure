<?php

/**
 * 稀疏数组
 *
 * Class sparseArray
 */
class SparseArray
{
    protected $array = [];

    protected $length = 0;

    public function __construct()
    {

    }

    /**
     * 制作稀疏数组
     *
     * @param array $arr
     * @param int $row_len 数组的行数
     * @param int $column_len 数组的列数
     * @return array|string
     */
    public function make(array $arr, $row_len, $column_len)
    {
        //获取有效值的个数
        $len = $this->getLength($arr);
        if ($len < 1) {
            return '数组不能为空';
        }

        $this->array[] = [
            0 => $row_len,
            1 => $column_len,
            2 => $len,
        ];

        foreach ($arr as $r_key => $items) {
            foreach ($items as $l_key => $value) {
                if ($value) {
                    $this->array[] = [
                        0 => $r_key,
                        1 => $l_key,
                        2 => $value,
                    ];
                }
            }
        }

        return $this->array;
    }

    /**
     * 将稀疏数组恢复成原来的样子
     *
     * @param array $arr
     * @return array
     */
    public function restore($arr)
    {
        $container = [];
        list($row_len, $column_len) = $arr[0];
        for ($i = 0; $i < $row_len; $i++) {
            for ($j = 0; $j < $column_len; $j++) {
                $container[$i][$j] = 0;
            }
        }

        foreach ($arr as $r_key => $row) {
            if ($r_key > 0) {
                $container[$row[0]][$row[1]] = $row[2];
            }
        }

        return $container;
    }

    /**
     * 获取有效值的个数
     *
     * @param array $arr ;
     * @return int;
     */
    public function getLength(array $arr)
    {
        if (!count($arr)) {
            return 0;
        }

        $length = 0;
        foreach ($arr as $key => $items) {
            foreach ($items as $k => $item) {
                if ($item) {
                    $length++;
                }
            }
        }

        return $length;
    }
}

$p = function ($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
};
$sparseArray = new SparseArray();
$data = [
    [1, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 3, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [1, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 5, 0, 0, 0],
];

$arr = $sparseArray->make($data, 6, 6);

$raw = $sparseArray->restore($arr);
$p($raw);


