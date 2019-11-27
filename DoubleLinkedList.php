<?php

class DoubleLinkedList
{
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
        while ($temp->next != null) {
            $temp = $temp->next;
        }

        $temp->next = $node;
        $node->prev = $temp;
    }

    /**
     * 将节点按编号顺序添加到链表中
     *
     * @param HeroNode $node
     */
    public function insertByNo(HeroNode $node)
    {
        $flag = false;
        $temp = $this->head;
        while ($temp->next !== null) {
            if ($temp->next->no > $node->no) {
                $flag = true;
                $node->next = $temp->next;
                $temp->next = $node;
                $node->prev = $temp;
                $node->next->prev = $node;
                break;
            }

            $temp = $temp->next;
        }

        if (!$flag) {
            $temp->next = $node;
            $node->prev = $temp;
        }
    }

    /**
     * 根据编号删除节点
     *
     * @param int $no 编号
     */
    public function delete($no)
    {
        $flag = false;
        $temp = $this->head->next;
        while ($temp != null) {
            if ($temp->no == $no) {
                $flag = true;
                $temp->prev->next = $temp->next;
                $temp->next->prev = $temp->prev;
                break;
            }

            $temp = $temp->next;
        }

        if (!$flag) {
            exit('没有找到要删除的节点');
        }
    }

    /**
     * 根据编号更新节点
     *
     * @param HeroNode $node
     * @param int $no 编号
     */
    public function update(HeroNode $node, $no)
    {
        $flag = false;
        $temp = $this->head->next;
        while ($temp != null) {
            if ($temp->no == $no) {
                $flag = true;
                $node->next = $temp->next;
                $node->prev = $temp->prev;
                $temp->prev->next = $node;
                $temp->next->prev = $node;
                break;
            }

            $temp = $temp->next;
        }

        if (!$flag) {
            exit('没有找到要修改的节点');
        }
    }

    /**
     * 打印输出整个链表
     *
     * @return void
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


class HeroNode
{
    /**
     * 名称
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
     * 编号
     *
     * @var
     */
    public $no;

    /**
     * 指向下个节点的值
     *
     * @var
     */
    public $next;

    /**
     * 指向上个节点的值
     *
     * @var
     */
    public $prev;

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

$link = new DoubleLinkedList(new HeroNode());
$link->insertByNo(new HeroNode('宋江', '及时雨', 1));
$link->insertByNo(new HeroNode('晁盖', '托塔天王', 0));
$link->insertByNo(new HeroNode('卢俊义', '玉麒麟', 2));
$link->insertByNo(new HeroNode('秦明', '霹雳火', 5));
$link->insertByNo(new HeroNode('吴用', '智多星', 3));
$link->insertByNo(new HeroNode('林冲', '豹子头', 4));
$link->delete(0);
$link->update(new HeroNode('公孙胜', '入云龙', 3), 3);
$link->update(new HeroNode('扈三娘', '一丈青', 3), 3);
$link->delete(4);
$link->show();
print_r($link);