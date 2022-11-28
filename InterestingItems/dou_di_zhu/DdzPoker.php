<?php

class DdzPoker
{
    // 花色类型
    const COLOR_TYPE_HEITAO = 0; // 黑桃
    const COLOR_TYPE_HONGTAO = 1; // 红桃
    const COLOR_TYPE_MEIHUA = 2; // 梅花
    const COLOR_TYPE_FANGKUAI = 3; // 方块
    const COLOR_TYPE_XIAOWANG = 4; // 小王
    const COLOR_TYPE_DAWANG = 5; // 大王

    // 牌显示出来的值
    const CARD_SAN = '3'; // 牌值3
    const CARD_SI = '4'; // 牌值4
    const CARD_WU = '5'; // 牌值5
    const CARD_LIU = '6'; // 牌值6
    const CARD_QI = '7'; // 牌值7
    const CARD_BA = '8'; // 牌值8
    const CARD_JIU = '9'; // 牌值9
    const CARD_SHI = '10'; // 牌值10
    const CARD_J = 'J'; // 牌值J
    const CARD_Q = 'Q'; // 牌值Q
    const CARD_K = 'K'; // 牌值K
    const CARD_A = 'A'; // 牌值A
    const CARD_ER = '2'; // 牌值2
    const CARD_XIAOWANG = 'SJ'; //牌值小王
    const CARD_DAWANG = 'BJ'; //牌值大王

    //牌型
    const CARD_TYPE_DAN = 1; //单张
    const CARD_TYPE_DUI = 2; //对子
    const CARD_TYPE_SAN = 3; //三张
    const CARD_TYPE_SANDAIYI = 4; //三代一
    const CARD_TYPE_SANDAIER = 5; //三代二
    const CARD_TYPE_SHUNZI = 6; //顺子
    const CARD_TYPE_LIANDUI = 7; //连对
    const CARD_TYPE_FEIJIBUDAI = 8; //飞机不带
    const CARD_TYPE_FEIJIDAIDAN = 9; //飞机带单
    const CARD_TYPE_FEIJIDAISHUANG = 10; //飞机带双
    const CARD_TYPE_SIDAIYI = 11; //四带一, 指的是四带一对
    const CARD_TYPE_SIDAIER = 12; //四带二, 指的是四带两队
    const CARD_TYPE_ZHADAN = 13; //炸弹
    const CARD_TYPE_HUOJIAN = 14; //火箭

    /**
     * 构造花色值
     * @var array
     */
    public static $card_color = [
        self::COLOR_TYPE_HEITAO => '黑桃',
        self::COLOR_TYPE_HONGTAO => '红桃',
        self::COLOR_TYPE_MEIHUA => '梅花',
        self::COLOR_TYPE_FANGKUAI => '方块',
        self::COLOR_TYPE_XIAOWANG => '小王',
        self::COLOR_TYPE_DAWANG => '大王',
    ];

    /**
     * 构造牌型值
     * @var array
     */
    public static $card_type = [
        self::CARD_TYPE_DAN => '单张',
        self::CARD_TYPE_DUI => '对子',
        self::CARD_TYPE_SAN => '三张',
        self::CARD_TYPE_SANDAIYI => '三带一',
        self::CARD_TYPE_SANDAIER => '三带二',
        self::CARD_TYPE_SHUNZI => '顺子',
        self::CARD_TYPE_LIANDUI => '连对',
        self::CARD_TYPE_FEIJIBUDAI => '飞机不带',
        self::CARD_TYPE_FEIJIDAIDAN => '飞机带单',
        self::CARD_TYPE_FEIJIDAISHUANG => '飞机带双',
        self::CARD_TYPE_SIDAIYI => '四带一对',
        self::CARD_TYPE_SIDAIER => '四带二对',
        self::CARD_TYPE_ZHADAN => '炸弹',
        self::CARD_TYPE_HUOJIAN => '火箭',
    ];

    /**
     * 构造扑克牌值列表(54张牌，采用16进制的模式， 每16位一种花色牌型，花色不一样, 大小王，固定值，这样设计，一个数字，既可以表示出牌值， 也能表示出花色）
     * @var array
     */
    public static $card_value_list = [
        1 => self::CARD_SAN, 2 => self::CARD_SI, 3 => self::CARD_WU, 4 => self::CARD_LIU, 5 => self::CARD_QI, 6 => self::CARD_BA, 7 => self::CARD_JIU, 8 => self::CARD_SHI, 9 => self::CARD_J, 10 => self::CARD_Q, 11 => self::CARD_K, 12 => self::CARD_A, 13 => self::CARD_ER,
        17 => self::CARD_SAN, 18 => self::CARD_SI, 19 => self::CARD_WU, 20 => self::CARD_LIU, 21 => self::CARD_QI, 22 => self::CARD_BA, 23 => self::CARD_JIU, 24 => self::CARD_SHI, 25 => self::CARD_J, 26 => self::CARD_Q, 27 => self::CARD_K, 28 => self::CARD_A, 29 => self::CARD_ER,
        33 => self::CARD_SAN, 34 => self::CARD_SI, 35 => self::CARD_WU, 36 => self::CARD_LIU, 37 => self::CARD_QI, 38 => self::CARD_BA, 39 => self::CARD_JIU, 40 => self::CARD_SHI, 41 => self::CARD_J, 42 => self::CARD_Q, 43 => self::CARD_K, 44 => self::CARD_A, 45 => self::CARD_ER,
        49 => self::CARD_SAN, 50 => self::CARD_SI, 51 => self::CARD_WU, 52 => self::CARD_LIU, 53 => self::CARD_QI, 54 => self::CARD_BA, 55 => self::CARD_JIU, 56 => self::CARD_SHI, 57 => self::CARD_J, 58 => self::CARD_Q, 59 => self::CARD_K, 60 => self::CARD_A, 61 => self::CARD_ER,
        78 => self::CARD_XIAOWANG,
        79 => self::CARD_DAWANG,
    ];

    /**
     * 洗好的牌
     * @var
     */
    public $washed_cards;

    /**
     * 洗牌
     * @return $this
     */
    public function washCards()
    {
        $cards = array_keys(self::$card_value_list);
        shuffle($cards);
        $show_cards = $this->createCard($cards);
        $this->washed_cards = [
            'cards' => $cards,
            'show_cards' => $show_cards,
        ];
        return $this;
    }

    /**
     * 发牌
     * @return array
     */
    public function dealCards()
    {
        $cards = $this->washed_cards['cards'];
        $user_card1 = $user_card2 = $user_card3 = $hand = [];

        $chunk = array_chunk($cards, 51);
        $hand = $chunk[1]; // 3张底牌
        $cards = $chunk[0]; // 可以摸的牌
        $cnt = count($cards);

        // 每人发17张牌
        for ($i = 0; $i < $cnt; $i +=3 ) {
            $user_card1[] = $cards[$i];
            $user_card2[] = $cards[$i + 1];
            $user_card3[] = $cards[$i + 2];
        }
        // 手牌进行整理
        $user_card1 = $this->_sortCardByGrade($user_card1);
        $user_card2 = $this->_sortCardByGrade($user_card2);
        $user_card3 = $this->_sortCardByGrade($user_card3);

        $card = [
            'user1' => $user_card1,
            'user2' => $user_card2,
            'user3' => $user_card3,
            'hand' => $hand
        ];
        $show_card = [
            'user1' => $this->createCard($user_card1),
            'user2' => $this->createCard($user_card2),
            'user3' => $this->createCard($user_card3),
            'hand' => $hand
        ];
        return [
            'card' => $card,
            'show_card' => $show_card
        ];
    }

    /**
     * 根据牌值构建牌
     * @param $card
     * @return array
     */
    public function createCard($card)
    {
        $data = [];
        foreach ($card as $v) {
            if ($v == 78) {
                $color_type = self::COLOR_TYPE_XIAOWANG;
            } elseif ($v == 79) {
                $color_type = self::COLOR_TYPE_DAWANG;
            } else {
                $color_type = intval($v / 16);
            }
            $color = self::$card_color[$color_type];
            $data[$v] = $color . '_' . self::$card_value_list[$v];
        }
        return $data;
    }

    /**
     * 判断是否为单牌
     * @param $arr_card
     * @return bool
     */
    public function isDan($arr_card)
    {
        if (count($arr_card) == 1) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否为对子
     * @param $arr_card
     * @return bool
     */
    public function isDui($arr_card)
    {
        if (count($arr_card) == 2 && ($this->_getModVal($arr_card[0]) == ($this->_getModVal($arr_card[1])))) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否为三张
     * @param $arr_card
     * @return bool
     */
    public function isSan($arr_card)
    {
        if (count($arr_card) == 3) {
            $value = $this->_getModVal($arr_card[0]);
            if (($this->_getModVal($arr_card[1]) == $value) && ($this->_getModVal($arr_card[2]) == $value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断是否三带一
     * @param $arr_card
     * @return bool
     */
    public function isSanDaiYi($arr_card)
    {
        if (count($arr_card) == 4) {
            // 排序
            $arr_card = $this->_sortCardByGrade($arr_card);

            // 判断单张是否是后面的
            if ($this->isSan(array_slice($arr_card, 0, 3))) {
                return true;
            }
            // 判断单张是否是前面的
            if ($this->isSan(array_slice($arr_card, 1, 3))) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断是否为三带二
     * @param $arr_card
     * @return bool
     */
    public function isSanDaiEr($arr_card)
    {
        if (count($arr_card) == 5) {
            // 排序
            $arr_card = $this->_sortCardByGrade($arr_card);

            // 判断对子是否是后面的
            if ($this->isSan(array_slice($arr_card, 0, 3))) {
                if ($this->isDui(array_slice($arr_card, 3, 2))) {
                    return true;
                }
            }

            // 判断对子是否是前面的
            if ($this->isSan(array_slice($arr_card, 2,3))) {
                if ($this->isDui(array_slice($arr_card, 0, 2))) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 判断是否为顺子
     * @param $arr_card
     * @return bool
     */
    public function isShunZi($arr_card)
    {
        $cnt = count($arr_card);
        if ($cnt >= 5 && $cnt <= 12) {
            // 排序
            $arr_card = $this->_sortCardByGrade($arr_card);

            // 排序之后，数量不等，代表有相等的牌
            if (count($arr_card) != $cnt) {
                return false;
            }

            for ($i = 0 ; $i < $cnt - 1; $i++) {
                // 过滤大小王，2
                if (!in_array($this->_getModVal($arr_card[$i]), [13, 14, 15])) {
                    if ($this->_getModVal($arr_card[$i+1]) - $this->_getModVal($arr_card[$i]) == 1) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 最值进行取模运算，获取到牌的值
     * @param $val
     * @return int
     */
    private function _getModVal($val)
    {
        return $val % 16;
    }

    /**
     * 对手牌进行排序处理
     * @param array $card
     * @return array
     */
    public function _sortCardByGrade($card = [])
    {
        $new_card = [];
        foreach ($card as $v) {
            $new_card[$v] = $this->_getModVal($v);
        }
        // 对数组按值排序，并保留键值
        asort($new_card);
        $card = [];
        foreach ($new_card as $k => $v) {
            $card[] = $k;
        }
        return $card;
    }

}

$obj = new DdzPoker();

var_dump($obj->isShunZi([3,4,5,6,7,8,7]));exit();


echo '<pre>';
$obj->washCards(); // 洗牌
var_dump('测试洗牌:----------------------------',$obj->washed_cards);
//var_dump('测试发牌:----------------------------',$obj->dealCards());