<?php

/**
 * Dida Framework  -- A Rapid Development Framework
 * Copyright (c) Zeupin LLC. (http://zeupin.com)
 *
 * Licensed under The MIT License.
 * Redistributions of files MUST retain the above copyright notice.
 */
use \PHPUnit\Framework\TestCase;
use \Dida\Debug\Debug;

/**
 * FileSystemTest
 */
class FileSystemTest extends TestCase
{


    public function test_getFiles_1()
    {
        echo "\n\n\n";
        $dir = __DIR__ . '/..';
        $files = Dida\Util\FileSystem::getFiles($dir);
        echo Debug::varExport($files);
    }


    public function test_getFiles_2()
    {
        echo "\n\n\n";
        $dir = __DIR__ . '/..';
        $files = Dida\Util\FileSystem::getFiles($dir, null, '.git, nbproject');
        echo Debug::varExport($files);
    }


    public function test_getFiles_3()
    {
        echo "\n\n\n";
        $dir = __DIR__ . '/..';
        $files = Dida\Util\FileSystem::getFiles($dir, '.php', '.git, nbproject');
        echo Debug::varExport($files);
    }
}
