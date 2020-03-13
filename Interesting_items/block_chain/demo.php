<?php

/**
 * 什么是区块链？官方的解释是：区块链是一个分布式记账系统，是藉用密码学串接并保护其内容的串连交易记录（又称区块）。每一个区块包含了前一个区块的加密散列、对应的时间戳记以及交易数据（通常用默克尔树算法计算的散列值表示），这样的设计使得区块内容具有难以被窜改的特性。用区块链所串接的分布式账本能让两方有效率地纪录交易，且此交易可永久被查验。
 */


/**
 * Class Block
 */
class Block {
    /**
     * 前一个区块的hash值
     * @var string
     */
    public $prevHash;

    /**
     * 当前区块的hash值
     * @var string
     */
    public $hash;

    /**
     * 区块生成的时间戳
     * @var integer
     */
    public $timeStamp;

    /**
     * 区块保存的数据
     * @var string
     */
    public $data;

    /**
     * 计数器
     * @var integer
     */
    public $nonce;

    public function __construct($prevHash, $data)
    {
        $this->prevHash = $prevHash;
        $this->timeStamp = time();
        $this->data = $data;
        $this->findBlockHash();
    }

    private function prepareData($nonce)
    {
        return json_encode([
            $this->prevHash,
            $this->timeStamp,
            $this->data,
            $nonce
        ]);
    }

    /**
     * 计算符合规则的hash值
     * @return bool
     */
    public function findBlockHash()
    {
        $found = false;
        $condition = '0000'; // hash值前N个字符必须等于$condition
        $condition_length = strlen($condition);

        printf("Mining the block containing \"%s\"\n", $this->data);
        for ($nonce = 0; $nonce < PHP_INT_MAX; $nonce++) {
            $data = $this->prepareData($nonce);
            $hash = hash('sha256', $data);
            printf("\r%d: %s", $nonce, $hash);
            if (substr($hash, 0, $condition_length) === $condition) {
                $found = true;
                break;
            }
        }

        print("\n\n");

        if ($found) {
            $this->nonce = $nonce;
            $this->hash = $hash;
        }

        return $found;
    }

    /**
     * 验证hash值
     * @return bool
     */
    public function validate()
    {
        $condition = '0000';
        $condition_length = strlen($condition);
        $data = $this->prepareData($this->nonce);

        return substr(hash('sha256', $data), 0, $condition_length) === $condition;
    }

    /**
     * 计算区块的hash值
     */
    public function setBlockHash()
    {
        // 整个区块序列化，然后使用hash()函数计算区块的Hash值，并赋值给hash字段
        $this->hash = hash('sha256', serialize($this));
    }

    public function getBlockHash()
    {
        return $this->hash;
    }
}

include 'CuteDB.php';

class BlockChain
{
    const dbFile = 'block_chain';
    const lastHashField = 'last_hash';

    private $_db = null;
    private $_lastHash = null;

    public $blocks = [];

    public function __construct()
    {
        $this->_db = new CuteDB();

        if (!$this->_db->open(self::dbFile)) {
            exit("Failed to create/open ".self::dbFile." database");
        }

        $this->_lastHash = $this->_db->get(self::lastHashField);
        if (!$this->_lastHash) {
            // 创世区块
            $block = new Block('', 'Genesis Block');
            $hash = $block->getBlockHash();
            $this->_db->set($hash, serialize($block));
            $this->_db->set(self::lastHashField, $hash);
            $this->_lastHash = $hash;
        }
    }

    public function addBlock($data)
    {
        $newBlock = new Block($this->_lastHash, $data);

        $hash = $newBlock->getBlockHash();

        $this->_db->set($hash, serialize($newBlock));
        $this->_db->set(self::lastHashField, $hash);
        $this->_lastHash = $hash;
    }

    public function printBlockChain()
    {
        $lastHash = $this->_lastHash;

        while (true) {
            $block = $this->_db->get($lastHash);
            if (!$block) {
                break;
            }

            $block = unserialize($block);

            printf("PrevHash: %s\n", $block->prevHash);
            printf("Hash: %s\n", $block->hash);
            printf("Data: %s\n", $block->data);
            printf("PoW: %s\n", $block->validate() ? 'true' : 'false');
            printf("Nonce: %s\n\n\n", $block->nonce);


            $lastHash = $block->prevHash;
        }
    }
}

$bc = new BlockChain();

$bc->addBlock('This is block1');
$bc->addBlock('This is block2');

$bc->printBlockChain();