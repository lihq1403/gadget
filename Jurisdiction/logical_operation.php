<?php

define('READ', 1); // 查
define('WRITE', 2); // 增
define('UPLOAD', 4); // 改
define('DELETE', 8); // 删

class LogicalOperation {

    public function add($user_permission, $operation)
    {
        return $user_permission | $operation;
    }

    public function del($user_permission, $operation)
    {
        return $user_permission ^ ($operation);
    }

    public function check($user_permission, $operation)
    {
        if ($user_permission & $operation) {
            echo '具有'.$operation.'权限'.PHP_EOL;
        } else {
            echo '不具有'.$operation.'权限'.PHP_EOL;
        }
    }
}

$user_permission = 7; // 当前用户权限
echo '初始权限：'.$user_permission.PHP_EOL;

$model = new LogicalOperation();
$user_permission = $model->add($user_permission, DELETE);
echo '增加了8的权限后：'.$user_permission.PHP_EOL;

$model->check($user_permission, WRITE);

$user_permission = $model->del($user_permission, WRITE|READ);
echo '删除了2和1的权限后：'.$user_permission.PHP_EOL;