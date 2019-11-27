<?php

/**
 * 环形链表
 *
 * Class CircleLinkedList
 */
class CircleLinkedList
{
    /**
     * 头节点
     *
     * @var HeroNode
     */
    public $head;

    public function __construct(HeroNode $head)
    {
        $this->head = $head;
    }

    /**
     * 向链表中添加节点
     *
     * @param HeroNode $node
     */
    public function insert(HeroNode $node)
    {
        $temp = $this->head;
        while ($temp->next !== null && $temp->next !== $this->head) {
            $temp = $temp->next;
        }

        $temp->next = $node;
        $node->next = $this->head;
    }

    /**
     * 利用环形链表解决约瑟夫问题
     *
     * @param int $num 数几下
     * @param int $no 从哪个编号开始数
     */
    public function Josephu($num, $no)
    {
        $first = $this->head;
        $helper = $first;
        //让$helper指向$first的后一个节点
        while ($helper->next !== $first) {
            $helper = $helper->next;
        }

        //寻找到开始数数的节点
        $temp = $this->head;
        while ($temp->next != $this->head) {
            if ($temp->no == $no) {
                break;
            } else {
                $temp = $temp->next;
                $first = $first->next;
                $helper = $helper->next;
            }
        }

        //开始出圈,当$helper等于$first时表示只剩一个节点就退出循环
        while ($helper !== $first) {
            $i = 0;
            while ($i < $num - 1) {
                $first = $first->next;
                $helper = $helper->next;
                $i++;
            }

            //输出节点
            echo $first;
            $first = $first->next;
            $helper->next = $first;
        }
        //将最后一个节点出圈
        echo $helper;
    }

    /**
     * 打印输出链表
     */
    public function show()
    {
        $temp = $this->head;
        while ($temp->next != $this->head) {
            echo $temp->next;
            $temp = $temp->next;
        }
    }
}

class HeroNode
{
    /**
     * 节点数据
     *
     * @var
     */
    public $name;

    /**
     * 昵称
     *
     * @var
     */
    public $nickname;

    /**
     * 排名
     *
     * @var
     */
    public $no;

    /**
     * 指向下个节点的链接
     *
     * @var
     */
    public $next;

    /**
     * HeroNode constructor.
     * @param string $name
     * @param string $nickname
     * @param string $no
     */
    public function __construct($name = '', $nickname = '', $no = '')
    {
        $this->no = $no;
        $this->name = $name;
        $this->nickname = $nickname;
    }

    public function __toString()
    {
        return "<pre>[名称:{$this->name}, 绰号:{$this->nickname}, 编号:$this->no]</pre>";
    }
}

class Josephu
{
    public function __construct($total, $num)
    {

    }
}


$link = new CircleLinkedList(new HeroNode('晁盖', '托塔天王', 0));
$link->insert(new HeroNode('宋江', '及时雨', 1));
$link->insert(new HeroNode('卢俊义', '玉麒麟', 2));
$link->insert(new HeroNode('吴用', '智多星', 3));
$link->insert(new HeroNode('林冲', '豹子头', 4));
//$link->show();
$link->Josephu(3, 3);
//print_r($link);