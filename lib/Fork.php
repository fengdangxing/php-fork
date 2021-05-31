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
        $pid = pcntl_fork();
        if ($pid > 0) {
            pcntl_wait($status);
        } elseif ($pid == 0) {
            $cid = pcntl_fork();
            if ($cid > 0) {
                exit();
            } elseif ($cid == 0) {
                $fuc();
                exit();
            } else {
                exit();
            }
        } else {
            exit();
        }
    }
}
