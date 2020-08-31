<?php

class Node
{
    // 节点值
    public $value;

    // 左子树
    public $left;

    // 右子树
    public $right;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class HuffmanTree
{

    /**
     * 创建一颗赫夫曼树
     *
     * @param array $values 节点值
     * @return object
     */
    public function make($values)
    {
        // 将节点值按小到大进行排序
        sort($values);
        // 将数组的值构建成节点对象
        $nodes = [];
        foreach ($values as $value) {
            $nodes[] = new Node($value);
        }

        while (count($nodes) > 1) {
            // 左子节点的取值为数组的最小值
            $left = array_shift($nodes);
            // 右子节点的取值为数组第二小的值
            $right = array_shift($nodes);
            // 父节点的取值为左右子节点的取值之和
            $parent = new Node($left->value + $right->value);
            $parent->left = $left;
            $parent->right = $right;
            // 将parent加入到节点数组中
            array_unshift($nodes, $parent);
        }

        // 返回赫夫曼树的头节点
        return $nodes[0];
    }
}

$huffmanTree = new HuffmanTree();
$tree = $huffmanTree->make([1, 3, 6, 5, 8, 20, 100, 1000]);
print_r($tree);


