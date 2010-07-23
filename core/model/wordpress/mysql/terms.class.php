<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/terms.class.php');
class Terms_mysql extends Terms {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>