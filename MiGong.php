<?php

class MiGong
{
    /**
     * 地图
     *
     * @var array
     */
    public $map = [
        [1, 1, 1, 1, 1, 1, 1],
        [1, 0, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 0, 0, 0],
        [1, 0, 0, 0, 0, 0, 1],
        [1, 0, 0, 0, 0, 0, 1],
        [1, 0, 0, 0, 0, 0, 1],
        [1, 1, 1, 1, 1, 1, 1],
    ];

    /**
     * 起始点x
     *
     * @var array
     */
    public $startX;

    /**
     * 起始点y
     *
     * @var array
     */
    public $startY;


    /**
     * 目标点x
     *
     * @var array
     */
    public $targetX;

    /**
     * 目标点y
     *
     * @var
     */
    public $targetY;

    /**
     * MiGong constructor.
     * @param $startX
     * @param $startY
     * @param $targetX
     * @param $targetY
     */
    public function __construct($startX, $startY, $targetX, $targetY)
    {
        $this->startX = $startX;
        $this->startY = $startY;
        $this->targetX = $targetX;
        $this->targetY = $targetY;
    }

    /**
     * 说明:
     * 1:表示墙不能走,2:表示通过,3:表示该点已经走过,但是走不通
     *
     * @param array $map
     * @param int $x
     * @param int $y
     * @return bool
     */
    public function setWay(array &$map, $x, $y)
    {
        if ($map[5][5] == 2) {
            return true;
        } else {
            if ($map[$x][$y] == 0) {
                $map[$x][$y] = 2;
                if ($this->setWay($map, $x + 1, $y)) {
                    return true;
                } else if ($this->setWay($map, $x, $y + 1)) {
                    return true;
                } else if ($this->setWay($map, $x - 1, $y)) {
                    return true;
                } else if ($this->setWay($map, $x, $y - 1)) {
                    return true;
                } else {
                    $map[$x][$y] = 3;
                    return false;
                }
            } else {
                return false;
            }

        }
    }

    public function exec()
    {
        $this->setWay($this->map, 1, 1);
        foreach ($this->map as $items) {
            foreach ($items as $val) {
                echo $val . '&nbsp,';
            }
            echo '</br>';
        }
    }
}

$miGong = new MiGong(1, 1, 5, 5);
$miGong->exec();