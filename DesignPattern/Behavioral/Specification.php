<?php

/**
 * 规格模式
 * 构建一个清晰的业务规则规范，其中每条规则都能被针对性地检查。每个规范类中都有一个称为 isSatisfiedBy 的方法，方法判断给定的规则是否满足规范从而返回 true 或 false。
 */


class Item
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

interface SpecificationInterface
{
    public function isSatisfiedBy(Item $item): bool;
}

class OrSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private array $specifications;

    /**
     * @param SpecificationInterface ...$specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * 如果有一条规则符合条件，返回 true，否则返回 false.
     */
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($item)) {
                return true;
            }
        }
        return false;
    }
}

class PriceSpecification implements SpecificationInterface
{
    private ?float $maxPrice;

    private ?float $minPrice;

    public function __construct(float $minPrice = null, float $maxPrice = null)
    {
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        if ($this->maxPrice !== null && $item->getPrice() > $this->maxPrice) {
            return false;
        }

        if ($this->minPrice !== null && $item->getPrice() < $this->minPrice) {
            return false;
        }

        return true;
    }
}

class AndSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private array $specifications;

    /**
     * @param SpecificationInterface ...$specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    /**
     * 如果有一条规则不符合条件，返回 false，否则返回 true.
     */
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specifications as $specification) {
            if (! $specification->isSatisfiedBy($item)) {
                return false;
            }
        }

        return true;
    }
}

class NotSpecification implements SpecificationInterface
{
    private SpecificationInterface $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        return ! $this->specification->isSatisfiedBy($item);
    }
}

$spec1 = new PriceSpecification(50, 99);
$spec2 = new PriceSpecification(101, 200);
$orSpec = new OrSpecification($spec1, $spec2);
var_dump($orSpec->isSatisfiedBy(new Item(100)));
var_dump($orSpec->isSatisfiedBy(new Item(51)));
var_dump($orSpec->isSatisfiedBy(new Item(150)));


$spec1 = new PriceSpecification(50, 100);
$spec2 = new PriceSpecification(80, 200);

$andSpec = new AndSpecification($spec1, $spec2);

$spec1 = new PriceSpecification(50, 100);
$notSpec = new NotSpecification($spec1);
