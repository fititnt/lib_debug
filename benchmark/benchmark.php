<?php

/**
 * @package     Debug Library
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('JDLIB_PATH') or die('Restricted access');


/**
 * @todo Implement bcadd to increase precision http://php.net/manual/pt_BR/function.bcadd.php
 */
class JDLibBenchmark {

    /**
     *
     * @var array $stack Array of objects 
     */
    private $stack;

    /**
     * 
     */
    public function __construct() {
        $this->stack[0] = new stdClass();
        $this->stack[0]->timestamp = microtime(true);
    }

    /**
     * 
     */
    function __destruct() {
        //
    }
    
    /**
     * Permit load one entire stack on the fly
     * 
     * @param array $stack Array of objects $stack 
     */
    public function initialize ($stack){
        unset($this->stack);
        $this->stack = $stack;
    }

    /**
     *
     * @return type 
     */
    public function start() {
        unset($this->stack);
        $this->stack[0]->timestamp = microtime(true);
        return $this->stack[0]->timestamp;
    }

    /**
     *
     * @param string $label Label to add this method
     * @param int $method 0 current timestamp; 1 timeparcial; 2 current totaltime 3 entire $this->stack
     * @param mixed $info Any type to insert togheter with the data
     * @return Mixed $result
     */
    public function stack($label = NULL, $method = 0, $info = NULL) {
        $i = count($this->stack);

        $this->stack[$i] = new stdClass();
        $this->stack[$i]->timestamp = microtime(true);
        if($label !== NULL){
            $this->stack[$i]->label = $label;
        }

        $this->stack[$i]->timeparcial = $this->stack[$i]->timestamp - $this->stack[$i-1]->timestamp;
        $this->stack[$i]->timetotal = $this->stack[$i]->timestamp - $this->stack[0]->timestamp;
        
        if ($info !== NULL){
            $this->stack[$i]->info = $info;
        }
        switch ($method){
            case 0:
                $result = $this->stack[$i]->timestamp;
                break;
            case 1:
                $result = $this->stack[$i]->timeparcial;
                break;
            case 2:
                $result = $this->stack[$i]->timetotal;
                break;
            case 3:
            default:
                $result = $this->stack;
                break;
        }
        return $result;        
    }

    /**
     *
     * @param string $label Label to add this method
     * @param int $method 0 current timestamp; 1 timeparcial; 2 current totaltime 3 entire $this->stack
     * @param mixed $info Any type to insert togheter with the data
     * @return Mixed 
     */
    public function end($label = NULL, $method = 0, $info = NULL) {
        $i = count($this->stack);

        $this->stack[$i] = new stdClass();
        $this->stack[$i]->timestamp = microtime(true);
        if($label !== NULL){
            $this->stack[$i]->label = $label;
        }
        if ($info !== NULL){
            $this->stack[$i]->info = $info;
        }
        $this->stack[$i]->timeparcial = $this->stack[$i]->timestamp - $this->stack[$i-1]->timestamp;
        $this->stack[$i]->timetotal = $this->stack[$i]->timestamp - $this->stack[0]->timestamp;
        $stack = $this->stack;
        
        switch ($method){
            case 0:
                $result = $this->stack[$i]->timestamp;
                break;
            case 1:
                $result = $this->stack[$i]->timeparcial;
                break;
            case 2:
                $result = $this->stack[$i]->timetotal;
                break;
            case 3:
            default:
                $result = $this->stack;
                break;
        }
        unset($this->stack);
        return $result;  
    }

    /**
     *
     * @return time current unix timestamp 
     */
    public function reset() {
        unset($this->stack);
        $this->stack[0]->timestamp = microtime(true);
        return $this->stack[0]->timestamp;
    }

    /**
     * Delete (set to NULL) generic variable
     * 
     * @param String $name: name of var do delete
     * @return Object $this
     */
    public function del($name) {
        $this->$name = NULL;
        return $this;
    }

    /**
     * Return generic variable
     * 
     * @param String $name: name of var to return
     * @return Mixed this->$name: value of var
     */
    public function get($name) {
        return $this->$name;
    }

    /**
     * Set one generic variable the desired value
     * 
     * @param String $name: name of var to set value
     * @param Mixed $value: value to set to desired variable
     * @return Object $this
     */
    public function set($name, $value) {
        $this->$name = $value;
        return $this;
    }

}

