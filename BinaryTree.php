<?php

/**
 * 节点类
 */
class HeroNode
{
    //名字
    public $name;
    //昵称
    public $nickname;
    //编号
    public $no;
    //左子树
    public $left;
    //右子树
    public $right;

    public function __construct($name, $nickname, $no)
    {
        $this->name = $name;
        $this->nickname = $nickname;
        $this->no = $no;
    }

    public function __toString()
    {
        return "姓名:$this->name, 昵称:$this->nickname, 编号:$this->no</br>";
    }
}


/**
 * 二叉树
 */
class BinaryTree
{
    //根节点
    public $root;

    public function __construct($root = '')
    {
        $this->root = $root;
    }

    public function insert(HeroNode $hero)
    {
        // if ($this->root == null) {
        // 	$this->root = $hero;
        // }

        // if ()
    }

    public function findByNo($root, $no)
    {
        if ($root->no == $no) {
            return $root;
        }

        if ($root->left !== null) {
            $node = $this->findByNo($root->left, $no);
            if ($node) {
                return $node;
            }
        }

        if ($root->right != null) {
            $node = $this->findByNo($root->right, $no);
            if ($node) {
                return $node;
            }
        }

        return '';
    }

    public function delete($root, $no)
    {
        if ($root->left->no == $no) {
            if ($this->isFull($root->left)) {
                $temp = $root->left->left;
                $temp->right = $root->left->right;
                $root->left = $temp;
            } else if ($this->isLeaf($root->left)) {
                $root->left = null;
            } else if ($root->left->left) {
                $root->left = $root->left->left;
            } else if ($root->left->right) {
                $root->left = $root->left->right;
            }

            return '删除成功:';
        }

        if ($root->right->no == $no) {
            if ($this->isFull($root->right)) {
                $temp = $root->right->left;
                $temp->right = $root->right->right;
                $root->right = $temp;
            } else if ($this->isLeaf($root->right)) {
                $root->right = null;
            } else if ($root->right->right) {
                $root->right = $root->right->right;
            } else if ($root->right->left) {
                $root->right = $root->right->left;
            }

            return '删除成功:';
        }

        if ($root->left !== null) {
            $result = $this->delete($root->left, $no);
            if ($result) {
                return $result;
            }
        }

        if ($root->right != null) {
            $result = $this->delete($root->right, $no);
            if ($result) {
                return $result;
            }
        }

        return '';
    }

    public function isLeaf($root)
    {
        return $root->left == null && $root->left == null;
    }

    public function isFull($root)
    {
        return $root->left !== null && $root->left !== null;
    }

    //前序遍历
    public function preOrder($root)
    {
        echo $root;

        if ($root->left != null) {
            $this->preOrder($root->left);
        }

        if ($root->right != null) {
            $this->preOrder($root->right);
        }
    }

    //中序遍历
    public function infixOrder($root)
    {

        if ($root->left != null) {
            $this->infixOrder($root->left);
        }

        echo $root;

        if ($root->right != null) {
            $this->infixOrder($root->right);
        }
    }

    //后序遍历
    public function postOrder($root)
    {

        if ($root->left != null) {
            $this->postOrder($root->left);
        }

        echo $root;

        if ($root->right != null) {
            $this->postOrder($root->right);
        }
    }

}

$root = new HeroNode('晁盖', '托塔天王', 1);
$hero2 = new HeroNode('宋江', '及时雨', 2);
$hero3 = new HeroNode('卢俊义', '玉麒麟', 3);
$hero4 = new HeroNode('吴用', '智多星', 4);
$hero5 = new HeroNode('公孙胜', '入云龙', 5);
$hero6 = new HeroNode('林冲', '豹子头', 6);
$root->left = $hero2;
$root->right = $hero3;
$hero2->left = $hero4;
$hero2->right = $hero5;
$hero3->left = $hero6;
$binaryTree = new BinaryTree();
//$binaryTree->infixOrder($root);
//$result = $binaryTree->findByNo($root, 4);
$result = $binaryTree->delete($root, 3);
print_r($root);
