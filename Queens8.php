<?php

class Queens8
{
    public $max = 8;

    public $map = [0, 0, 0, 0, 0, 0, 0, 0];

    public function exec()
    {
        $this->check(0);
    }

    public function check($n)
    {
        if ($n == $this->max) {
            return print_r($this->map);
        }

        $i = 0;
        while ($i < $this->max) {
            $i++;
            $this->map[$n] = $i;
            if ($this->judge($n)) {
                $this->check($n + 1);
            }
        }
    }

    /**
     * 是否位置是否冲突
     *
     * @param $n
     * @return bool
     */
    public function judge($n)
    {
        $i = 0;
        while ($i < $n) {
            if ($this->map[$i] == $this->map[$n] || abs($n - $i) == abs($this->map[$n] - $this->map[$i])) {
                return false;
            }
            $i++;
        }

        return true;
    }
}


function arr_sort(array &$data)
{
    $len = count($data);
    for ($i = 0; $i < $len; $i++) {
        for ($j = $i + 1; $j < $len; $j++) {
            if ($data[$i] > $data[$j]) {
                $temp = $data[$i];
                $data[$i] = $data[$j];
                $data[$j] = $temp;
            }
        }
    }
}

function select_sort(array &$data)
{
    $len = count($data);
    for ($i = 0; $i < $len; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $len; $j++) {
            if ($data[$min] > $data[$j]) {
                $min = $j;
            }
        }

        if ($i != $min) {
            $temp = $data[$i];
            $data[$i] = $data[$min];
            $data[$min] = $temp;
        }
    }
}

function insert_sort(array $data)
{
//    $arr = [];
//    $a = implode()
}

//$arr = [9, 0, 10, 2, 5, 20, 3, 4, 8, 9, 1, 4, 5];
//select_sort($arr);
//print_r($arr);
echo str_replace(' ', '%20', 'We Are Happy');

//$queens = new Queens8();
//$queens->exec();