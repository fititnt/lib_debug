<?php

/**
 * @package     Debug Library
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('JDLIB_PATH') or die('Restricted access');

class JDLibLog {

    /**
     * @var Object $log
     */
    private $log;

    /**
     *
     * @var array $options
     */
    private $options;

    /**
     *
     * @var int $userId
     */
    private $userId;

    /**
     *
     * @var string $userName
     */
    private $userName;

    /**
     * Error level
     * Level 9: BREAKPOINT. Alias for DEBUG.
     * Level 8: DEBUG. Debugging message.
     * Level 7: INFO. Informational message.
     * Level 6: NOTICE. Normal, but significant condition.
     * Level 5: WARNING. Warning conditions.
     * Level 4: ERROR. Error conditions.
     * Level 3: CRITICAL. Critical conditions.
     * Level 2: ALERT. Action must be taken immediately.
     * Level 1: EMERGENCY. The system is unusable.
     * Level 0: No error report
     * 
     * @var int $level
     */
    private $level;

    /**
     * 
     */
    public function __construct() {
        jimport('joomla.error.log');
        $this->options = NULL;
        //$options = array(
        //    'format' => "{DATE}\t{TIME}\t{USER_ID}\t{COMMENT}";
        //);

        if (!defined('JDLIB_LEVEL')) {
            $this->level = 7;
        } else {
            $this->level = JDLIB_LEVEL;
        }
        $user = &JFactory::getUser();
        $this->userId = $user->guest ? -1 : $user->get('id');
        $this->userName = $user->guest ? 'guest' : $user->get('username');
        $this->log = &JLog::getInstance(LIB_CORRETOR_LOG, $this->options);
    }

    /**
     * 
     */
    function __destruct() {
        //
    }

    /**
     * Debug information
     * $aditionalInfo = "\e" is for scape char.
     * 
     * @return void
     */
    public function breakpoint($message, $aditionalInfo = "\e") {
        if ($this->level >= 9) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 128, 'comment' => $message));
        }
    }

    /**
     * Debug information
     * @example
     * @code
     *      jimport('debug.debug');
     *      $log = JDLib::getLog();
     *      $log->debug("JDLib Debug test");
     * @endcode
     * @example
     * @code
     *      jimport('debug.debug');
     *      $log = JDLib::getLog();
     *      $log->debug(__CLASS__.':'.__METHOD__.':'.__LINE__.'>'."Initialized");
     * @endcode
     * 
     * @return void
     */
    public function debug($message, $aditionalInfo = "\e") {
        if ($this->level >= 8) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 128, 'comment' => $message));
        }
    }

    /**
     * Info information
     * @return void
     */
    public function info($message, $aditionalInfo = "\e") {
        if ($this->level >= 7) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 64, 'comment' => $message));
        }
    }

    /**
     * Notice information
     * @return void
     */
    public function notice($message, $aditionalInfo = "\e") {
        if ($this->level >= 6) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 32, 'comment' => $message));
        }
    }

    /**
     * Warning information
     * @return void
     */
    public function warning($message, $aditionalInfo = "\e") {
        if ($this->level >= 5) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 16, 'comment' => $message));
        }
    }

    /**
     * Error information
     * @return void
     */
    public function error($message, $aditionalInfo = "\e") {
        if ($this->level >= 4) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 8, 'comment' => $message));
        }
    }

    /**
     * Critical information
     * @return void
     */
    public function critical($message, $aditionalInfo = "\e") {
        if ($this->level >= 3) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 4, 'comment' => $message));
        }
    }

    /**
     * Alert information
     * @return void
     */
    public function alert($message, $aditionalInfo = "\e") {
        if ($this->level >= 2) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 2, 'comment' => $message));
        }
    }

    /**
     * Critical information
     * @return void
     */
    public function emergency($message, $aditionalInfo = "\e") {
        if ($this->level >= 1) {
            if ($aditionalInfo != "\e") {
                $message = $this->_printfSpecial($message, $aditionalInfo);
            }
            $this->log->addEntry(array('priority' => 1, 'comment' => $message));
        }
    }
    
    /**
     * Add a custom log
     * 
     * @param array $params 
     * @return void
     */
    public function custom($params) {
        $this->log->addEntry($params);
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

    /**
     * Receive one string and one mixed var, encode this var like JSON and
     * try find for a %s on $message; if found, replease with encoded var, else
     * will just add at the end of $message
     * 
     * @param string $message
     * @param mixed $var
     * @return string $result
     */
    private function _printfSpecial($message, $var) {
        if(strpos($message,'%s')=== FALSE){
            $result = $message . ' ' . json_encode($var);
        } else {
            $result = str_replace('%s', json_encode($var), $message);
        }        
        return $result;
    }

}

