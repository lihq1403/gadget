<?php

/**
 * 状态模式，当一个对象的内在状态改变时允许改变其行为，这个对象看起来像是改变了其类。

面向对象设计其实就是希望做到代码的责任分解。

状态模式主要解决的当控制一个对象状态转换的条件表达式过于复杂时的情况。把状态的判断逻辑转移到表示不同状态的一系列类当中，可以把复杂的判断逻辑简单化。

将于特定状态相关的行为局部化，并且将不同状态的行为分割开来。

将特定的状态相关的行为都放入一个对象中，由于所有与状态相关的代码都存在于某个ConcreteState中，所以通过定义的子类可以很容易地增加新的状态和转换。

消除了庞大的条件分支语句。

状态模式通过把各种状态转移逻辑分布到State的子类之间，来减少项目之间的依赖。

当一个对象的行为取决于它的状态，并且它必须在运行时刻根据状态改变它的行为时，就可以考虑使用状态模式了。
 */


class Work
{
    private State $current;

    private int $hour;

    private bool $finished = false;

    public function __construct()
    {
        // 初始化工作
        $this->current = new ForenoonState();
    }

    public function getHour(): int
    {
        return $this->hour;
    }

    public function setHour(int $hour): void
    {
        $this->hour = $hour;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): void
    {
        $this->finished = $finished;
    }

    public function writeProgram()
    {
        $this->current->writeProgram($this);
    }

    public function setState(State $state)
    {
        $this->current = $state;
    }
}

abstract class State
{
    abstract public function writeProgram(Work $work);
}

class ForenoonState extends State
{
    public function writeProgram(Work $work)
    {
        if ($work->getHour() < 12) {
            echo '当前时间：' . $work->getHour() . ' 上午工作，精神百倍' . PHP_EOL;
        } else {
            $work->setState(new NoonState());
            $work->writeProgram();
        }
    }
}

class NoonState extends State
{
    public function writeProgram(Work $work)
    {
        if ($work->getHour() < 13) {
            echo '当前时间：' . $work->getHour() . ' 饿了，午饭；犯困，午休' . PHP_EOL;
        } else {
            $work->setState(new AfterNoonState());
            $work->writeProgram();
        }
    }
}

class AfterNoonState extends State
{
    public function writeProgram(Work $work)
    {
        if ($work->getHour() < 17) {
            echo '当前时间：' . $work->getHour() . ' 下午状态不错，继续努力' . PHP_EOL;
        } else {
            $work->setState(new EveningState());
            $work->writeProgram();
        }
    }
}

class EveningState extends State
{
    public function writeProgram(Work $work)
    {
        if ($work->isFinished()) {
            //如果完成任务，下班
            $work->setState(new RestState());
            $work->writeProgram();
        } else {
            if ($work->getHour() < 21) {
                echo '当前时间：' . $work->getHour() . ' 加班哦，疲惫之极' . PHP_EOL;
            } else {
                //超过21点，则转入睡眠工作状态
                $work->setState(new SleepingState());
                $work->writeProgram();
            }
        }
    }
}

class SleepingState extends State
{
    public function writeProgram(Work $work)
    {
        echo '当前时间：' . $work->getHour() . ' 不行了，睡觉' . PHP_EOL;
    }
}

class RestState extends State
{
    public function writeProgram(Work $work)
    {
        echo '当前时间：' . $work->getHour() . ' 下班回家' . PHP_EOL;
    }
}

$emergencyProjects = new Work();
$emergencyProjects->setHour(9);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(10);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(12);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(13);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(14);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(17);

$emergencyProjects->setFinished(false);
$emergencyProjects->writeProgram();

$emergencyProjects->setHour(19);
$emergencyProjects->writeProgram();
$emergencyProjects->setHour(22);
$emergencyProjects->writeProgram();

//$emergencyProjects = new Work();
//$emergencyProjects->setHour(9);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(10);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(12);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(13);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(14);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(17);
//
//$emergencyProjects->setFinished(true);
//$emergencyProjects->writeProgram();
//
//$emergencyProjects->setHour(19);
//$emergencyProjects->writeProgram();
//$emergencyProjects->setHour(22);
//$emergencyProjects->writeProgram();