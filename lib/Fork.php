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
        if (substr(php_sapi_name(), 0, 3) == 'cli') {
            self::ProcessCli($fuc);
        } else {
            self::ProcessWeb($fuc);
        }

    }

    private static function ProcessWeb(callable $fuc)
    {
        ignore_user_abort(true);
        //\Yii::$app->response->send();
        $size = ob_get_length();
        header("Content-Length: $size");  //告诉浏览器数据长度,浏览器接收到此长度数据后就不再接收数据
        header("Connection: Close");      //告诉浏览器关闭当前连接,即为短连接
        ob_flush();
        flush();

        if (function_exists("fastcgi_finish_request")) {
            fastcgi_finish_request();
            //响应完成, 关闭连接

            //执行后期代码
            ob_start();
            $fuc();
        }
    }

    private static function ProcessCli(callable $fuc)
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
