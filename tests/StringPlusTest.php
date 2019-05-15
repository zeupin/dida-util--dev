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
use \Dida\Util\StringPlus;


/**
 * StringPlusTest
 */
class StringPlusTest extends TestCase
{


    public function test_matchPrefix()
    {
        $this->assertTrue(StringPlus::matchPrefix("foo_abcd", 'foo_'));
        $this->assertTrue(StringPlus::matchPrefix("foo_abcd", null));
    }


    public function test_matchSuffix()
    {
        $this->assertTrue(StringPlus::matchSuffix('foo1234.php', '.php'));
        $this->assertTrue(StringPlus::matchSuffix("foo1234.php", [".php", ".txt"]));
    }
}
