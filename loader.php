<?php

/**
 * @package     Debug Library
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('JDLIB_PATH') or die('Restricted access');

/**
 *
 */
abstract class JDLib {

    /**
     *
     * @var Object $benchmark
     */
    public static $benchmark;

    /**
     *
     * @var Object $log
     */
    public static $log;

    /**
     * Return Benchmark Object, creating if aready doesent exists
     *
     * @return Object $benchmark
     */
    public static function getBenchmark() {
        if (!self::$benchmark) {
            jimport('debug.benchmark.load');

            self::$benchmark = LoadBenchmark::getInstance();
        }
        return self::$benchmark;
    }

    /**
     * Return Log Object, creating if aready doesent exists
     *
     * @return Object $log
     */
    public static function getLog() {
        if (!self::$log) {
            jimport('debug.log.load');

            self::$log = LoadLog::getInstance();
        }
        return self::$log;
    }

}