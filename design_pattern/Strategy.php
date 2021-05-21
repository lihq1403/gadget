<?php

/**
 * 分离「策略」并使他们之间能互相快速切换。此外，这种模式是一种不错的继承替代方案（替代使用扩展抽象类的方式）。
 *
 * 策略这个词应该怎么理解，打个比方说，我们出门的时候会选择不同的出行方式，比如骑自行车、坐公交、坐火车、坐飞机、坐火箭等等，这些出行方式，每一种都是一个策略。

　　再比如我们去逛商场，商场现在正在搞活动，有打折的、有满减的、有返利的等等，其实不管商场如何进行促销，说到底都是一些算法，这些算法本身只是一种策略，并且这些算法是随时都可能互相替换的，比如针对同一件商品，今天打八折、明天满100减30，这些策略间是可以互换的。

　　策略模式（Strategy），定义了一组算法，将每个算法都封装起来，并且使它们之间可以互换。
 */

class Context
{
    private $comparator;

    public function __construct(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;
    }

    public function execteStrategy(array $elements): array
    {
        uasort($elements, [$this->comparator, 'compare']);

        return $elements;
    }
}

interface ComparatorInterface
{
    public function compare($a, $b): int;
}

class DataComparator implements ComparatorInterface
{
    public function compare($a, $b): int
    {
        $aData = new \DateTime($a['data']);
        $bData = new \DateTime($b['data']);

        return $aData <=> $bData;
    }
}

class IdComparator implements ComparatorInterface
{
    public function compare($a, $b): int
    {
        return $a['id'] <=> $b['id'];
    }
}

$idArr = [
    [
        [['id' => 2], ['id' => 1], ['id' => 3]],
        ['id' => 1],
    ],
    [
        [['id' => 3], ['id' => 2], ['id' => 1]],
        ['id' => 1],
    ],
];

$dataArr = [
    [
        [['date' => '2014-03-03'], ['date' => '2015-03-02'], ['date' => '2013-03-01']],
        ['date' => '2013-03-01'],
    ],
    [
        [['date' => '2014-02-03'], ['date' => '2013-02-01'], ['date' => '2015-02-02']],
        ['date' => '2013-02-01'],
    ],
];

$obj = new Context(new IdComparator());
$elements = $obj->execteStrategy($idArr);
//var_dump($elements);

$obj = new Context(new DataComparator());
$elements = $obj->execteStrategy($dataArr);
//var_dump($elements);

/**
 * 旅游出行策略
 * Interface TravelStrategy
 */
interface TravelStrategy
{
    /**
     * 行程算法
     * @return mixed
     */
    public function travelAlgorithm();
}

/**
 * 飞机策略
 * Class AirPlaneStrategy
 */
class AirPlaneStrategy implements TravelStrategy
{
    public function travelAlgorithm()
    {
        echo "travel by AirPlane".PHP_EOL;
    }
}

/**
 * 火车策略
 * Class TrainStrategy
 */
class TrainStrategy implements TravelStrategy
{
    public function travelAlgorithm()
    {
        echo "travel by Train".PHP_EOL;
    }
}

/**
 * 小汽车策略
 * Class CarStrategy
 */
class CarStrategy implements TravelStrategy
{
    public function travelAlgorithm()
    {
        echo "travel by Car".PHP_EOL;
    }
}

/**
 * 环境类(Context):用一个ConcreteStrategy对象来配置。维护一个对Strategy对象的引用
 * 算法解决类，以提供客户选择使用何种解决方案
 * Class PersonContext
 */
class PersonContext
{
    private $_strategy = null;

    public function __construct(TravelStrategy $travelStrategy)
    {
        $this->_strategy = $travelStrategy;
    }

    public function setTravelStrategy(TravelStrategy $travelStrategy)
    {
        $this->_strategy = $travelStrategy;
    }

    public function travel()
    {
        return $this->_strategy->travelAlgorithm();
    }
}

// 乘坐飞机
$person = new PersonContext(new AirPlaneStrategy());
$person->travel();

// 改乘火车
$person->setTravelStrategy(new TrainStrategy());
$person->travel();

// 改乘小汽车
$person->setTravelStrategy(new CarStrategy());
$person->travel();