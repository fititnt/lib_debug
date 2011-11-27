<?php

/**
 * @package     Debug Library
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('JDLIB_PATH') or die('Restricted access');

class LoadBenchmark {

    /**
     *
     * @return JDLibBenchmark 
     */
    public static function getInstance() {
        require_once dirname(__FILE__) . DS . 'benchmark.php';
        $instance = new JDLibBenchmark();
        return $instance;
    }

}