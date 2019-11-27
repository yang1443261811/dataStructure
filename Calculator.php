<?php

/**
 * 利用stack实现计算器
 *
 * Class Calculator
 */
class Calculator
{
    /**
     * 数字栈
     *
     * @var array
     */
    public $numberStack = [];

    /**
     * 符号栈
     *
     * @var array
     */
    public $operatorStack = [];


    /**
     * 执行运算
     *
     * @param $expression
     * @return int
     */
    public function exec($expression)
    {
        $i = 0;
        $len = strlen($expression);
        while ($i < $len) {
            $value = $expression[$i];
            $i++;
            //如果不是一个运算符,值直接入数栈
            if (!$this->isOperator($value)) {
                array_push($this->numberStack, $value);
                continue;
            }

            //如果符号栈为空,值直接入符号栈
            if (count($this->operatorStack) == 0) {
                array_push($this->operatorStack, $value);
                continue;
            }

            //符号栈不为空的话,比较符号栈里最后一个运算符与待插入运算符的优先级
            //如果待插入运算符的优先级高直接入栈
            //如果符号栈最后一个运算符优先级高,则从数栈出栈两个值,符号栈出栈一个值,将它们进行运算
            //运算完成后将计算结果入数栈,将待插入的运算符入符号栈
            $level1 = $this->getOperatorLevel($value);
            $level2 = $this->getOperatorLevel(end($this->operatorStack));
            if ($level2 > $level1) {
                $number1 = array_pop($this->numberStack);
                $number2 = array_pop($this->numberStack);
                $operator = array_pop($this->operatorStack);
                $result = $this->compute($number1, $operator, $number2);
                array_push($this->operatorStack, $value);
                array_push($this->numberStack, $result);
            } else {
                array_push($this->operatorStack, $value);
            }
        }

        //表达式完成入栈操作后,按顺序依次从数栈和符号栈取出值进行运算操作.
        //数栈的最后一个值就是整个表达式的运算结果
        while (count($this->operatorStack) > 0 && count($this->numberStack)) {
            $number1 = array_shift($this->numberStack);
            $number2 = array_shift($this->numberStack);
            $operator = array_shift($this->operatorStack);
            $result = $this->compute($number1, $operator, $number2);
            array_push($this->numberStack, $result);
        }

        echo '计算结果是: ' . end($this->numberStack);
    }
    

    /**
     * 给定一个运算符返回这个运算符的优先级
     *
     * @param $operator
     * @return int
     */
    public function getOperatorLevel($operator)
    {
        return in_array($operator, ['*', '/']) ? 1 : 0;
    }

    /**
     * 执行一个运算
     *
     * @param $number1
     * @param $operator
     * @param $number2
     * @return float|int
     */
    public function compute($number1, $operator, $number2)
    {
        switch ($operator) {
            case '+' :
                return $number1 + $number2;
            case '-' :
                return $number2 - $number1;
            case '*' :
                return $number1 * $number2;
            case '/' :
                return $number2 / $number1;
            default :
                trigger_error('错误的运算符');
        }
    }

    /**
     * 给定一个字符判断是否是运算符
     *
     * @param $str
     * @return bool
     */
    public function isOperator($str)
    {
        $operators = ['+', '-', '*', '/'];

        return in_array($str, $operators);
    }
}

$expression = '2*3+6/3-4';
$calculator = new Calculator();
$calculator->exec($expression);
//print_r($calculator->operatorStack);
//print_r($calculator->numberStack);