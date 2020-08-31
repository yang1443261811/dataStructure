-----<?php

class Node
{
    public $no;

    public $left;

    public $right;

    public function __construct($no)
    {
        $this->no = $no;
    }
}

/**
 * 顺序存储二叉树
 *
 * Class ArrBinaryTree
 */
class ArrBinaryTree
{
    public function preOrder($arr, $i = 0)
    {
        if ($arr == null || count($arr) == 0) {
            return;
        }

        echo $arr[$i] . '</br>';

        if ($i * 2 + 1 < count($arr)) {
            $this->preOrder($arr, $i * 2 + 1);
        }

        if ($i * 2 + 2 < count($arr)) {
            $this->preOrder($arr, $i * 2 + 2);
        }
    }

    public function toArray($root, $index = 0, $arr = [])
    {
        if (!$root) {
            return $arr;
        }

        $arr[] = $root->no;

        $this->toArray($root->left);

        $this->toArray($root->right);
    }
}

//$root = new Node(1);
//$node2 = new Node(2);
//$node3 = new Node(3);
//$node4 = new Node(4);
//$node5 = new Node(5);
//$node6 = new Node(6);
//$node7 = new Node(7);
//$root->left = $node2;
//$root->right = $node3;
//$node2->left = $node4;
//$node2->right = $node5;
//$node3->left = $node6;
//$node3->right = $node7;
//print_r($root);
//die;
$tree = new ArrBinaryTree();
$tree->preOrder([1, 2, 3, 4, 5, 6, 7], 0);