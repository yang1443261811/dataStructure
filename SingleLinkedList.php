<?php

/**
 * 单链表
 *
 * Class SingleLinked
 */
class SingleLinkedList
{
    /**
     * 链表的头节点
     *
     * @var
     */
    public $head;

    /**
     * 链表的容量
     *
     * @var
     */
    public $length;

    /**
     * SingleLinkedList constructor.
     * @param HeroNode $node
     * @param int $length
     */
    public function __construct(HeroNode $node, $length)
    {
        $this->head = $node;
        $this->length = $length;
    }

    /**
     * 向链表中追加节点
     *
     * @param HeroNode $node
     */
    public function insert(HeroNode $node)
    {
        $temp = $this->head;
        while ($temp->next !== null) {
            $temp = $temp->next;
        }

        $temp->next = $node;
    }

    /**
     * 根据编号删除节点
     *
     * @param int $no 编号
     * @return void
     */
    public function delete($no)
    {
        $found = false;
        $temp = $this->head;
        while ($temp !== null) {
            if ($temp->next->no == $no) {
                $found = true;
                break;
            }

            $temp = $temp->next;
        }

        if ($found) {
            $temp->next = $temp->next->next;
        } else {
            exit('没有找到要删除的节点');
        }
    }

    /**
     * 根据节点编号更新节点
     *
     * @param int $no 节点的编号
     * @param HeroNode $node
     */
    public function update($no, HeroNode $node)
    {
        $found = false;
        $temp = $this->head;
        while ($temp !== null) {
            if ($temp->next->no == $no) {
                $found = true;
                break;
            }

            $temp = $temp->next;
        }

        if ($found) {
            $node->next = $temp->next->next;
            $temp->next = $node;
        } else {
            exit('没有找到要删除的节点');
        }
    }

    /**
     * 反转链表
     *
     * @return HeroNode
     */
    public function reverse()
    {
        $node = '';
        $temp = $this->head->next;
        $newLinkedList = new HeroNode();
        while ($temp != null) {
            $node = $temp;
            $temp = $temp->next;
            $node->next = $newLinkedList->next;
            $newLinkedList->next = $node;
        }

        return $newLinkedList;
    }

    /**
     * 对链表进行遍历输出
     *
     * @param object $head 链表的头节点
     */
    public function show($head)
    {
        if ($head->next == null) {
            exit('链表为空');
        }

        $temp = $head->next;
        while ($temp !== null) {
            echo $temp;
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

$hero = new HeroNode();
$link = new SingleLinkedList($hero, 10);
$link->insert(new HeroNode('宋江', '及时雨', 1));
$link->insert(new HeroNode('卢俊义', '玉麒麟', 2));
$link->insert(new HeroNode('吴用', '智多星', 3));
$link->insert(new HeroNode('林冲', '豹子头', 4));
//$link->update(1, new HeroNode('晁盖', '托塔天王', 1));
//$link->delete(1);
$a = $link->reverse();
$link->show($a);
//print_r($a);