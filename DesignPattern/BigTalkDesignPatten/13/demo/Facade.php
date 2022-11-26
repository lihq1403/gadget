<?php

class Stock1
{
    public function sell()
    {
        echo "股票1 卖出".PHP_EOL;
    }

    public function buy()
    {
        echo "股票1 买入".PHP_EOL;
    }
}

class Stock2
{
    public function sell()
    {
        echo "股票2 卖出".PHP_EOL;
    }

    public function buy()
    {
        echo "股票2 买入".PHP_EOL;
    }
}

class Stock3
{
    public function sell()
    {
        echo "股票3 卖出".PHP_EOL;
    }

    public function buy()
    {
        echo "股票3 买入".PHP_EOL;
    }
}

class NationalDebt1
{
    public function sell()
    {
        echo "国债1 卖出".PHP_EOL;
    }

    public function buy()
    {
        echo "国债1 买入".PHP_EOL;
    }
}

class Realty1
{
    public function sell()
    {
        echo "房地产1 卖出".PHP_EOL;
    }

    public function buy()
    {
        echo "房地产1 买入".PHP_EOL;
    }
}

class Fund
{
    public function __construct(
        protected Stock1 $stock1 = new Stock1(),
        protected Stock2 $stock2 = new Stock2(),
        protected Stock3 $stock3 = new Stock3(),
        protected NationalDebt1 $nationalDebt1 = new NationalDebt1(),
        protected Realty1 $realty1 = new Realty1(),
    ){
    }

    public function buy()
    {
        $this->stock1->buy();
        $this->stock2->buy();
        $this->stock3->buy();
        $this->nationalDebt1->buy();
        $this->realty1->buy();
    }

    public function sell()
    {
        $this->stock1->sell();
        $this->stock2->sell();
        $this->stock3->sell();
        $this->nationalDebt1->sell();
        $this->realty1->sell();
    }
}

$fund = new Fund();
$fund->buy();
$fund->sell();