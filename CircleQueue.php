<?php

/**
 * 环形队列
 *
 * Class CircleQueue
 */
class CircleQueue
{
    /**
     * 保存队列数据的数组
     *
     * @var array
     */
    protected $queue = [];

    /**
     * 队列的最大长度
     *
     * @var
     */
    protected $maxSize;

    /**
     * 队列的头
     *
     * @var
     */
    protected $head = 0;

    /**
     * 队列的尾
     *
     * @var
     */
    protected $tail = 0;

    /**
     * CircleQueue constructor.
     * @param int $maxSize 队列的最大长度
     */
    public function __construct($maxSize)
    {
        $this->maxSize = $maxSize;

        $this->queue = array_fill(0, $maxSize, 0);
    }

    /**
     * 向队列添加数据
     *
     * @param $value
     * @throws Exception
     */
    public function push($value)
    {
        if ($this->isFull()) {
            throw new Exception('队列满了');
        }

        $this->queue[$this->tail] = $value;
        $this->tail = ($this->tail + 1) % $this->maxSize;
    }

    /**
     * 从队列取数据
     *
     * @return mixed
     * @throws Exception
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            throw new Exception('队列是空的');
        }

        $index = $this->head;
        $this->head = ($index + 1) % $this->maxSize;

        return $this->queue[$index];
    }

    /**
     * 打印队列里的数据
     */
    public function dump()
    {
        $len = $this->getLength();
        if ($len < 1) {
            exit('队列为空!');
        }

        $i = 0;
        $index = 0;
        while ($i < $len) {
            $index = ($this->head + $i) % $this->maxSize;
            echo $this->queue[$index];
            echo '</br>';
            $i++;
        }
    }

    /**
     * 获取队列的长度
     *
     * @return int
     */
    public function getLength()
    {
        return ($this->tail + $this->maxSize - $this->head) % $this->maxSize;
    }

    /**
     * 判断队列是否为空
     *
     * @return bool
     */
    public function isEmpty()
    {
        return $this->head == $this->tail;
    }

    /**
     * 判断队列是否满了
     *
     * @return bool
     */
    public function isFull()
    {
        return ($this->tail + 1 + $this->maxSize) % $this->maxSize == $this->head;
    }

}

$queue = new CircleQueue(5);
$queue->push('visible');
$queue->push('secret');
$queue->push('direction');
$queue->push('dollar');
$queue->pop();
$queue->push('a hundred dollar');
$queue->pop();
$queue->pop();
$queue->pop();
$queue->pop();
$queue->push('safe');
$queue->push('guard');
$queue->push('angel');
$queue->push('wing');
$queue->dump();
