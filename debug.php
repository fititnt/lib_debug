<?php

/**
 * @package     Debug Library
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - @fititnt
 * @copyright   Copyright (C) 2011 Webdesign Assessoria em Tecniligia da Informacao. All rights reserved.
 * @license     GNU General Public License version 3. See license.txt
 */
defined('_JEXEC') or die('Restricted access');

if (!defined('JDLIB_PATH')) {
    define('JDLIB_PATH', dirname(__FILE__));
}

/**
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
 * Level -1: System Default
 */
if (!defined('JDLIB_LEVEL')) {
    define('JDLIB_LEVEL', 9);
}

require_once dirname(__FILE__) . DS . 'loader.php';