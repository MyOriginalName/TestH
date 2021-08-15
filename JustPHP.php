<?php
// Реализовать функцию findSimple ($a, $b). $a и $b – целые положительные числа. Результат ее выполнение: массив простых чисел от $a до $b.
echo "Task first";
echo "<br/><br/>";

function findSimple($a, $b)
{
    $arr = array();

    for($i=$a; $i <= $b; $i++)
    {
       $check = false;
       for($j=2; $j < $i && !$check; $j++)
       {
           if($i%$j == 0)
           {
               $check = true;
               break;
           }
       }
       if(!$check && $i != 1)
       {
           $arr[] = $i;
       }
    }
    return $arr;
}
$num1 = 1;
$num2 = 47;
print_r (findSimple($num1, $num2));

//Реализовать функцию createTrapeze($a). $a – массив положительных чисел, количество элементов кратно 3. Результат ее выполнение: двумерный массив (массив состоящий из ассоциативных массива с ключами a, b, c). Пример для входных массива [1, 2, 3, 4, 5, 6] результат [[‘a’=>1,’b’=>2,’с’=>3],[‘a’=>4,’b’=>5 ,’c’=>6]].
echo "<br/><br/>";
echo "Task second";
echo "<br/><br/>";


function createTrapeze($a)
{
    $arr = array();
    for($i=0; $i < count($a); $i+=3)
    {
        $arr[$i] = array(
            'a' => $a[$i],
            'b' => $a[$i+1],
            'c' => $a[$i+2]
        );
    }
    return $arr = array_values($arr);
}
print_r(createTrapeze(findSimple($num1, $num2)));

//Реализовать функцию squareTrapeze($a). $a – массив результата выполнения функции createTrapeze(). Результат ее выполнение: в исходный массив для каждой тройки чисел добавляется дополнительный ключ s, содержащий результат расчета площади трапеции со сторонами a и b, и высотой c.
echo "<br/><br/>";
echo "Task third";
echo "<br/><br/>";

function squareTrapeze($a)
{
    foreach($a as $k => &$n){

        $n['s'] = (($n['a']+$n['b'])/2)*$n['c'];

    }
    return $a;
}

print_r(squareTrapeze(createTrapeze(findSimple($num1, $num2))));

//Реализовать функцию getSizeForLimit($a, $b). $a – массив результата выполнения функции squareTrapeze(), $b – максимальная площадь. Результат ее выполнение: массив размеров трапеции с максимальной площадью, но меньше или равной $b.

echo "<br/><br/>";
echo "Task fourth";
echo "<br/><br/>";
function getSizeForLimit($a, $b)
{
    $arr = array();
    foreach($a as $k => $v)
    {
        if($v['s'] <= $b) $arr[] = $v['s'];
    }
    return $arr;
}

$b = 67.5;
print_r(getSizeForLimit(squareTrapeze(createTrapeze(findSimple($num1, $num2))), $b));

//Реализовать функцию getMin($a). $a – массив чисел. Результат ее выполнения: минимальное числа в массиве (не используя функцию min, ключи массив может быть ассоциативный).
echo "<br/><br/>";
echo "Task fifth";
echo "<br/><br/>";

function getMin($a)
{
    $min = $a[0];
    foreach($a as $k => $v)
    {
        if($v < $min) $min = $v;
    }
    return $min;
}

$array = array(
    8, 90, 5, 16, 29, 32, 5, 9, 2, 35
);
print_r (getMin($array));

//Реализовать функцию printTrapeze($a). $a – массив результата выполнения функции squareTrapeze(). Результат ее выполнение: вывод таблицы с размерами трапеций, строки с нечетной площадью трапеции отметить любым способом
echo "<br/><br/>";
echo "Task sixth";
echo "<br/><br/>";

function printTrapeze($a)
{
    echo '<table border="5" width="50%" align="center">';
    foreach($a as $k => $v)
    {
        echo "<tr>";
        foreach($v as $key => $value)
        {
            if($key == 's' && $value%2)
            {
                echo "<td style = 'background-color: #0033FF'>$value</td>";
            } else
                echo "<td>$value</td>";
        }
        echo "</tr>"."<br/>";
    }
    echo "</table>";
}
printTrapeze(squareTrapeze(createTrapeze(findSimple($num1, $num2))));


//Реализовать абстрактный класс BaseMath содержащий 3 метода: exp1($a, $b, $c) и exp2($a, $b, $c),getValue(). Метода exp1 реализует расчет по формуле a*(b^c). Метода exp2 реализует расчет по формуле (a/b)^c. Метод getValue() возвращает результат расчета класса наследника.
echo "<br/><br/>";
echo "Task seventh";
echo "<br/><br/>";

abstract class BaseMath
{
    function exp1($a, $b, $c)
    {
        return $a*(pow($b, $c));
    }

    function exp2($a, $b, $c)
    {
        return pow(($a/$b), $c);
    }
    abstract public function getValue();
}

//Реализовать класс F1 наследующий методы BaseMath, содержащий конструктор с параметрами ($a, $b, $c) и метод getValue(). Класс реализует расчет по формуле f=(a*(b^c)+(((a/c)^b)%3)^min(a,b,c)).

class F1 extends BaseMath
{
    private $f;
    function __constructor($a, $b, $c)
    {

        $this->f = $this->exp1($a, $b, $c) + pow($this->exp2($a, $b, $c)%3, min($a, $b, $c));
    }
    function getValue()
    {
        return $this->f;
    }
}

$user = new F1(2,1,3);
echo $user->getValue();
?>