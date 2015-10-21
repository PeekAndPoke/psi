<?php
/**
 * File was created 08.05.2015 15:10
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Horizons\Tests;

/**
 * LocalDateTestHHVM
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class LocalDateTestHHVM extends LocalDateTest
{
    public function setUp()
    {
        if (!defined('HHVM_VERSION')) {
            define('HHVM_VERSION', 'XXX');
        }
    }
}
