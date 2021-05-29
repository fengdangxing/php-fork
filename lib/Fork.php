<?php

namespace fengdangxing\fork;
/**
 * @desc 开启子进程
 * @author 1
 * @version v2.1
 * @date: 2021/05/29
 * Class Fork
 * @package fengdangxing\fork
 */
class Fork
{
    public static function Process(callable $fuc)
    {
        $child_pid = pcntl_fork();
        if ($child_pid) {
            call_user_func($fuc);
            //die();
        }
    }
}
