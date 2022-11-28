<?php

/**
 * 只能包含方法、静态方法。不允许包含属性，包含属性的 trait 会导致 fatal 错误。
 */
trait GetValues
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

/**
 * 枚举可以实现interface，不能abstract
 */
interface Hello
{
    public function hello(): string;
}

/**
 * 禁止构造、析构函数。
 * 不支持继承。无法 extend 一个 enum。
 * 不支持静态属性和对象属性。
 * 由于枚举条目是单例对象，所以不支持对象复制。
 * 除了下面列举项，不能使用魔术方法。
 * enum 可以 implement 任意数量的 interface。
 * 枚举和它的条目都可以附加 注解。 目标过滤器 TARGET_CLASS 包括枚举自身。 目标过滤器 TARGET_CLASS_CONST 包括枚举条目。
 * 不能用 new 直接实例化枚举条目， 也不能用 ReflectionClass::newInstanceWithoutConstructor() 反射实例化。
 */
enum Suit: string implements Hello
{
    use GetValues;

    case Hearts = 'H';
    case Diamonds = 'D';
    case Clubs = 'C';
    case Spades = 'S';
//    case Spades1 = 'S'; error 不能有重复的回退值，一定是唯一的

    const H = 1;
    const D = 1;
    const C = 1;
    const S = 1;

    public function hello(): string
    {
        return 'hello Suit.' . $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function fromLength(int $cm): Suit
    {
        return match ($cm) {
            Suit::H => Suit::Hearts,
            Suit::D => Suit::Diamonds,
            Suit::C => Suit::Clubs,
            Suit::S => Suit::Spades,
        };
    }
}

var_dump(Suit::cases());
// array(4) {
//     [0]=>
//   enum(Suit::Hearts)
//   [1]=>
//   enum(Suit::Diamonds)
//   [2]=>
//   enum(Suit::Clubs)
//   [3]=>
//   enum(Suit::Spades)
// }

var_dump(Suit::values());
// array(4) {
//     [0]=>
//   string(1) "H"
//     [1]=>
//   string(1) "D"
//     [2]=>
//   string(1) "C"
//     [3]=>
//   string(1) "S"
// }

var_dump(Suit::Hearts->hello()); // string(17) "hello Suit.Hearts"

var_dump(Suit::Hearts->getValue()); // string(1) "H"
var_dump(Suit::fromLength(Suit::H)); // enum(Suit::Hearts)
var_dump(Suit::tryFrom('C')); // enum(Suit::Clubs)
var_dump(serialize(Suit::Diamonds)); // string(21) "E:13:"Suit:Diamonds";"
var_dump(Suit::Hearts === unserialize(serialize(Suit::Hearts))); // bool(true)

function query(Suit $suit)
{
    var_dump($suit);
}
query(Suit::Clubs); // enum(Suit::Clubs)