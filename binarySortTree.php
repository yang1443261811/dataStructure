<?php

class Node
{
    /**
     * 左子树
     *
     * @var object
     */
    public $left;

    /**
     * 右子树
     *
     * @var object
     */
    public $right;

    /**
     * 节点值
     *
     * @var string
     */
    public $value;

    /**
     * Node constructor.
     * @param $value 节点值
     */
    public function __construct($value)
    {
        $this->value = $value;

    }

    /**
     * 添加节点
     *
     * @param Node $node
     */
    public function add(Node $node)
    {
        //如果待插入的值大于当前子树的值,则向右边查找插入的位置
        if ($node->value > $this->value) {
            //如果右子树为空直接插入
            if (!$this->right) {
                $this->right = $node;
            } else {
                //右子树不为空继续递归向右子树查找插入的位置
                $this->right->add($node);
            }
        } //待插入值小于当前子树的值,向左子树寻找插入的位置
        else {
            //左子树为空直接插入
            if (!$this->left) {
                $this->left = $node;
            } else {
                //左子树不为空继续递归
                $this->left->add($node);
            }
        }
    }

    /**
     * 根据节点值查找节点
     *
     * @param $value
     * @return $this|null
     */
    public function find($value)
    {
        if ($value === $this->value) {
            return $this;
        }

        if ($value <= $this->value && $this->left) {
            return $this->left->find($value);
        }

        if ($value > $this->value && $this->right) {
            return $this->right->find($value);
        }

        return null;
    }

    /**
     * 根据节点值查找父节点
     *
     * @param $value
     * @return $this|null
     */
    public function findParent($value)
    {
        if (($this->left && $this->left->value == $value) ||
            ($this->right && $this->right->value == $value)) {
            return $this;
        }

        if ($value <= $this->value && $this->left) {
            return $this->left->findParent($value);
        }

        if ($value > $this->value && $this->right) {
            return $this->right->findParent($value);
        }

        return null;
    }
}

/**
 * 二叉排序树
 *
 * Class binarySortTree
 */
class binarySortTree
{
    /**
     * 根节点
     *
     * @var Object
     */
    public $root;

    /**
     * 添加节点
     *
     * @param Node $node
     */
    public function add(Node $node)
    {
        if ($this->root) {
            $this->root->add($node);
        } else {
            $this->root = $node;
        }
    }

    /**
     * 中序遍历
     *
     * @param Node $root
     * @return null
     */
    public function infixOrder($root)
    {
        if (!$root) {
            return null;
        }

        if ($root->left) {
            $this->infixOrder($root->left);
        }

        echo $root->value . '</br>';

        if ($root->right) {
            $this->infixOrder($root->right);
        }
    }

    /**
     * 根据节点值查找节点
     *
     * @param $value
     * @return Object|null
     */
    public function find($value)
    {
        if ($this->root) {
            return $this->root->find($value);
        } else {
            return null;
        }
    }

    /**
     * 根据节点值查找父节点
     *
     * @param $value
     * @return Object|null
     */
    public function findParent($value)
    {
        if ($this->root) {
            return $this->root->findParent($value);
        } else {
            return null;
        }
    }

    /**
     * 根据节点值删除节点
     *
     * @param $value
     * @return bool
     */
    public function delNode($value)
    {
        if (!$this->root) {
            return false;
        }

        //查找要删除的目标节点
        $targetNode = $this->find($value);
        //如果目标节点不存在直接返回
        if (!$targetNode) {
            return false;
        }

        //如果二叉树只有一个节点则直接删除
        if ($this->isLeaf($this->root)) {
            $this->root = null;
            return true;
        }

        //如果要删除的节点是一棵满的二叉树
        if ($this->isFull($targetNode)) {
            $minVal = $this->delRightTreeMin($targetNode->right);
            $targetNode->value = $minVal;
            return true;
        }

        //查找目标节点的父节点
        $parentNode = $this->findParent($value);

        //如果要删除的节点是叶子节点
        if ($this->isLeaf($targetNode)) {
            //判断删除的是左节点还是右节点
            if ($parentNode->left->value == $value) {
                $parentNode->left = null;
            } else {
                $parentNode->right = null;
            }

            return true;
        }

        //如果父节点为空
        if (!$parentNode) {
            if ($targetNode->left) {
                $this->root = $targetNode->left;
            } else {
                $this->root = $targetNode->right;
            }

            return true;
        }

        //如果要删除的节点只有一个子节点找到这个节点
        if ($targetNode->left) {
            $grandsonNode = $targetNode->left;
        } else {
            $grandsonNode = $targetNode->right;
        }

        //将孙子节点挂到目标节点的父节点上
        if ($parentNode->left == $targetNode) {
            $parentNode->left = $grandsonNode;
        } else {
            $parentNode->right = $grandsonNode;
        }

        return true;
    }

    /**
     * 删除节点最左边的子节点并返回节点值
     *
     * @param Node $node
     * @return string|节点值
     */
    public function delRightTreeMin(Node $node)
    {
        $target = $node;
        while ($target->left) {
            $target = $target->left;
        }

        $this->delNode($target->value);

        return $target->value;
    }

    /**
     * 判断节点是否是叶子节点
     *
     * @param $node
     * @return bool
     */
    public function isLeaf($node)
    {
        return $node->left == null && $node->right == null;
    }

    /**
     * 判断节点是不是满的二叉树
     *
     * @param $node
     * @return bool
     */
    public function isFull($node)
    {
        return $node->left !== null && $node->right !== null;
    }

    public function getRoot()
    {
        return $this->root;
    }
}

$tree = new binarySortTree();
$array = [7, 3, 10, 12, 5, 1, 9, 4];
$root = '';
foreach ($array as $value) {
    $node = new Node($value);
    $tree->add($node);
    if (!$root) {
        $root = $node;
    }
}


$node = $tree->delNode(7);
$node = $tree->delNode(3);
$node = $tree->delNode(4);
$node = $tree->delNode(1);
$node = $tree->delNode(12);
$node = $tree->delNode(5);
$node = $tree->delNode(10);
//$node = $tree->delNode(9);
$tree->infixOrder($tree->root);
//print_r($tree->root);