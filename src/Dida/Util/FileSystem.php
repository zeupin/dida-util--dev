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
 * FileSystem
 */
class FileSystem
{
    /**
     * Version
     */
    const VERSION = '20171115';


    /**
     * 获取指定目录下的指定类型的文件。
     *
     * @param string $dir               要搜索的目录
     * @param string|array $extensions  指定文件名的后缀
     * @param string|array $ignores     需要忽略的文件名
     *
     * @return array   满足的文件清单
     */
    public static function getFiles($dir, $extensions = null, $ignores = null)
    {
        // 如果目录不存在，返回false
        if (!file_exists($dir) || !is_dir($dir)) {
            return [];
        }

        // 准备忽略文件列表
        if ($ignores === null) {

        } elseif (is_string($ignores)) {
            $ignores = explode(',', $ignores);
            foreach ($ignores as $key => $item) {
                $ignores[$key] = trim($item);
            }
        } elseif (is_array($ignores)) {
            foreach ($ignores as $key => $item) {
                $ignores[$key] = trim($item);
            }
        } else {
            throw new Exception('Invalid argument type $ignores.');
        }

        // 准备文件扩展名列表
        if ($extensions === null) {

        } elseif (is_string($extensions)) {
            $extensions = explode(',', $extensions);
            foreach ($extensions as $key => $item) {
                $item = trim($item);
                $extensions[$key] = ['ext' => $item, 'len' => mb_strlen($item)];
            }
        } elseif (is_array($extensions)) {
            foreach ($extensions as $key => $item) {
                $item = trim($item);
                $extensions[$key] = ['ext' => $item, 'len' => mb_strlen($item)];
            }
        } else {
            throw new Exception('Invalid argument type $extensions.');
        }

        // 准备返回的数组
        $ret = [];

        // 待扫描数组
        $todo = [];
        $todo[] = realpath($dir);

        while (true) {
            // 取出下一个要扫描的目录作为当前目录
            $folder = array_shift($todo);

            // 当前目录的子目录
            $subfolders = [];

            // 获取所有文件
            $files = scandir($folder);

            foreach ($files as $file) {
                // 滤除 . 和 ..
                if ($file === '.' || $file === '..') {
                    continue;
                }

                // 检查是否在忽略列表内
                if (is_array($ignores)) {
                    if (in_array($file, $ignores)) {
                        continue;
                    }
                }

                // 当前文件/目录的绝对路径
                $path = $folder . DIRECTORY_SEPARATOR . $file;

                // 如果是子目录，先记录下来
                if (is_dir($path)) {
                    $subfolders[] = $path;
                    continue;
                }

                // 检查文件名后缀是否满足条件
                if ($extensions === null) {
                    $ret[] = $path;
                } elseif (is_array($extensions)) {
                    foreach ($extensions as $ext) {
                        if (mb_substr($file, -$ext['len']) === $ext['ext']) {
                            $ret[] = $path;
                        }
                    }
                }
            }

            // 如果当前目录有子目录，则将所有子目录合并到待扫描目录的前面
            if ($subfolders) {
                $todo = array_merge($subfolders, $todo);
            }

            // 如果已经全部扫描完，结束
            if (!$todo) break;
        }

        // 返回结果
        return $ret;
    }
}
