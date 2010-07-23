<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/options.class.php');
class Options_mysql extends Options {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>