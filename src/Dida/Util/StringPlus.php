<?php
/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */

namespace Dida\Util;


/**
 * StringPlus 字符串扩展类
 */
class StringPlus
{

    /**
     * Version
     */
    const VERSION = '20190515';


    /**
     * 检查一个字符串是否是以指定的前缀开头
     *
     * @param string $str   字符串
     * @param string|array $prefixes   可以指定一个或者一组前缀
     *
     * @return boolean   返回验证结果true/false
     */
    public static function matchPrefix($str, $prefixes)
    {
        // 特定的情景
        if ($prefixes === null || $prefixes === '') {
            return true;
        }

        // 如果给出一个字符串前缀
        if (is_string($prefixes)) {
            $len = mb_strlen($prefixes);
            return (mb_substr($str, 0, $len) === $prefixes);
        }

        // 如果给出一组前缀
        if (is_array($prefixes)) {
            foreach ($prefixes as $prefix) {
                if (is_string($prefix)) {
                    $len = mb_strlen($prefix);
                    if (mb_substr($str, 0, $len) === $prefix)
                        return true;
                }
            }
            return false;
        }

        // 其它返回false
        return false;
    }


    /**
     * 检查一个字符串是否是以指定的后缀结尾
     *
     * @param string $str
     * @param string|array $suffixes   可以指定一个或者一组后缀
     *
     * @return boolean   返回验证结果true/false
     */
    public static function matchSuffix($str, $suffixes)
    {
        // 特定的情景
        if ($suffixes === null || $suffixes === '') {
            return true;
        }

        // 如果给出一个字符串后缀
        if (is_string($suffixes)) {
            $len = mb_strlen($suffixes);
            return (mb_substr($str, -$len) === $suffixes);
        }

        // 如果给出一组后缀
        if (is_array($suffixes)) {
            foreach ($suffixes as $suffix) {
                if (is_string($suffix)) {
                    $len = mb_strlen($suffix);
                    if (mb_substr($str, -$len) === $suffix) {
                        return true;
                    }
                }
            }
            return false;
        }

        // 其它返回false
        return false;
    }


    /**
     * 生成随机字符串
     *
     * @param int $num     字母个数
     * @param string $set  字符串的可用字符
     */
    public static function randomString($num = 32, $set = null)
    {
        if (!$set) {
            $set = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        $len = strlen($set);
        $r = [];
        for ($i = 0; $i < $num; $i++) {
            $r[] = substr($set, mt_rand(0, $len - 1), 1);
        }
        return implode('', $r);
    }
}
