<?php

class Node
{
    //节点值
    public $data;

    //权重
    public $weight;

    //节点的路径值
    public $code = '';

    //左子树
    public $left;

    //右子树
    public $right;

    public function __construct($data, $weight = 1)
    {
        $this->data = $data;
        $this->weight = $weight;
    }

    public function __toString()
    {
        return "[data:$this->data weight: $this->weight]</br>";
    }
}

class HuffmanCode
{
    /**
     * 节点对象数组
     *
     * @var array
     */
    public $nodes = [];

    /**
     * 赫夫曼编码字典数组
     *
     * @var array
     */
    public $dictionary = [];

    /**
     * 生成赫夫曼编码
     *
     * @param string $text 字符串
     * @return mixed
     */
    public function encode($text)
    {
        //将字符串分割成单个字符,并计算每个字符出现的次数,然后将它们组成节点对象
        for ($i = 0; $i < strlen($text); $i++) {
            $key = $data = ord($text[$i]);
            if (isset($this->nodes[$key])) {
                $this->nodes[$key]->weight++;
            } else {
                $this->nodes[$key] = new Node($data);
            }
        }

        //创建赫夫曼树
        while (count($this->nodes) > 1) {
            //按权重对节点进行排序
            $this->sortByWight();
            //取出第一颗最小的二叉树
            $leftNode = array_shift($this->nodes);
            //取出第二颗最小的二叉树
            $rightNode = array_shift($this->nodes);
            //构建一颗新的二叉树,它的根节点没有data,只有权值
            $parent = new Node(null, $leftNode->weight + $rightNode->weight);
            $parent->left = $leftNode;
            $parent->right = $rightNode;
            //将新的二叉树加入到nodes中
            array_push($this->nodes, $parent);
        }

        //获取赫夫曼树根节点
        $huffmanTree = $this->nodes[0];
        //生成编码字典
        $dictionary = $this->getDictionary($huffmanTree);
        //对原始字符串进行压缩编码
        $encodeData = $this->compress($text, $dictionary);

        return ['data' => $encodeData, 'dictionary' => $dictionary];
    }

    /**
     * 对原始字符进行压缩编码
     *
     * @param string $text 待压缩的原始字符串
     * @param array $dictionary 赫夫曼编码字典
     * @return string
     */
    public function compress($text, $dictionary)
    {
        $binary = '';
        //根据字典将原始字符串翻译成赫夫曼编码
        for ($i = 0; $i < strlen($text); $i++) {
            $key = ord($text[$i]);
            $binary .= $dictionary[$key];
        }

        $bytes = '';
        $len = strlen($binary);
        //将赫夫曼编码8位一组转化成10进制数字
        for ($i = 0; $i < $len; $i += 8) {
            //如果剩余的字符长度不够8位就截取到末尾
            if ($i + 8 > $len) {
                $str = substr($binary, $i);
            } else {
                $str = substr($binary, $i, 8);
            }

            $bytes .= chr(bindec($str));
        }

        return $bytes;
    }

    /**
     * 对赫夫曼编码后的字符进行解压
     *
     * @param string $str 待解码的字符
     * @param array $dictionary 解码字典
     * @return string
     */
    public function decode($str, $dictionary)
    {
        $bytes = '';
        $len = strlen($str);
        //将字符转换为二进制的字符
        for ($i = 0; $i < $len; $i++) {
            $num = ord($str[$i]);
            //将每个二进制字符补齐为8位,最后一位字符不用补
            if ($i < $len - 1) {
                $bytes .= str_pad(base_convert($num, 10, 2), 8, '0', STR_PAD_LEFT);
            } else {
                $bytes .= base_convert($num, 10, 2);
            }
        }

        $originalString = '';
        $dictionary = array_flip($dictionary);
        $bytesLen = strlen($bytes);
        //将赫夫曼编码逐个扫描,从字典中找到对应的ASCII码,再将对应的ASCII码转换成字符,就得到了原始字符
        for ($i = 0; $i < $bytesLen;) {
            $count = 1;
            while (true) {
                //逐个截取比对
                $key = substr($bytes, $i, $count);
                //如果在字典中没匹配上,则链接下个字符直到匹配上
                if (isset($dictionary[$key])) {
                    $originalString .= chr($dictionary[$key]);
                    break;
                } else {
                    $count++;
                }
            }
            //跳过已匹配的字符
            $i += $count;
        }

        return $originalString;
    }

    /**
     * 对节点对象进行排序
     *
     * @return void
     */
    public function sortByWight()
    {
        usort($this->nodes, function ($nodeA, $nodeB) {
            return $nodeA->weight <=> $nodeB->weight;
        });
    }

    /**
     * 生成赫夫曼编码字典
     *
     * @param Object $tree 赫夫曼树
     * @param string $code
     * @param string $path
     * @return array|void
     */
    public function getDictionary($tree, $code = '', $path = '')
    {
        if (!$tree) {
            return;
        }
        //记录树的路径
        $path .= $code;
        //如果是叶子节点,保存叶子节点的路径
        if ($tree->data) {
            $this->dictionary[$tree->data] = $path;
        }

        $this->getDictionary($tree->left, '0', $path);
        $this->getDictionary($tree->right, '1', $path);

        return $this->dictionary;
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
}

$str = "i like like like java do you like a java";
$huffmanCode = new HuffmanCode();
$result = $huffmanCode->encode($str);
$string = $huffmanCode->decode($result['data'], $result['dictionary']);
print_r($string);


