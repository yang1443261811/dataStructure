<?php

/**
 * Class HashTable
 */
class HashTable
{
    /**
     * 哈希表的容量
     *
     * @var int
     */
    public $max;

    /**
     * 哈希表的容器
     *
     * @var array
     */
    public $container = [];

    /**
     * HashTable constructor.
     * @param int $max 哈希表的容量
     */
    public function __construct($max)
    {
        $this->max = $max;
        $i = 0;
        //根据给定的容量值初始化哈希表
        while ($i < $max) {
            $this->container[$i] = new LinkedList();
            $i++;
        }
    }

    /**
     * 向哈希表中添加数据
     *
     * @param Employee $node
     */
    public function add(Employee $node)
    {
        $key = $this->hashFun($node->id);

        $this->container[$key]->add($node);
    }

    /**
     * 根据ID查找对应的数据
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $key = $this->hashFun($id);

        return $this->container[$key]->getById($id);
    }

    public function dump()
    {
        $i = 0;
        while ($i < $this->max) {
            $this->container[$i]->show();
            $i++;
        }
    }

    /**
     * 散列函数
     *
     * @param int $key
     * @return int
     */
    private function hashFun($key)
    {
        return $key % $this->max;
    }
}

/**
 * Class LinkedList
 */
class LinkedList
{
    /**
     * 链表的头
     *
     * @var object
     */
    public $head;

    /**
     * 向链表中添加节点
     *
     * @param Employee $node
     */
    public function add(Employee $node)
    {
        if ($this->head == null) {
            $this->head = $node;
        } else {
            $temp = $this->head;
            while ($temp->next != null) {
                $temp = $temp->next;
            }

            $temp->next = $node;
        }
    }

    /**
     * 根据ID查找链表中的节点
     *
     * @param $id
     * @return object|null
     */
    public function getById($id)
    {
        if ($this->head == null) {
            return null;
        }

        $found = null;
        $temp = $this->head;
        while ($temp != null) {
            if ($temp->id == $id) {
                $found = $temp->toArray();
                break;
            }

            $temp = $temp->next;
        }

        return $found;
    }

    /**
     * 打印链表的所有节点
     */
    public function show()
    {
        $temp = $this->head;
        while ($temp != null) {
            echo $temp;
            $temp = $temp->next;
        }
    }
}

/**
 * Class Employee
 */
class Employee
{
    public $id;

    public $name;

    public $nickname;

    public $next;

    public function __construct($id, $name, $nickname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nickname = $nickname;
    }

    public function __toString()
    {
        return "id:{$this->id},姓名:{$this->name},绰号:{$this->nickname}</br>";
    }

    public function toArray()
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'nickname' => $this->nickname,
        ];
    }
}

$hashTab = new HashTable(8);
$hashTab->add(new Employee(1, '晁盖', '托塔天王'));
$hashTab->add(new Employee(2, '宋江', '及时雨'));
$hashTab->add(new Employee(3, '卢俊义', '玉麒麟'));
$hashTab->add(new Employee(4, '吴用', '智多星'));
$hashTab->add(new Employee(5, '公孙胜', '入云龙'));
$hashTab->add(new Employee(6, '林冲', '豹子头'));
$hashTab->add(new Employee(7, '秦明', '霹雳火'));
$hashTab->add(new Employee(8, '呼延灼', '双鞭呼延灼'));
$hashTab->add(new Employee(9, '花荣', ' 小李广'));
$hashTab->add(new Employee(10, '李应', '扑天雕'));
print_r($hashTab->getById(1));
//$hashTab->dump();
//print_r($hashTab->container);
#!/bin/bash