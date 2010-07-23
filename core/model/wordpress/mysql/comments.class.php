<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/comments.class.php');
class Comments_mysql extends Comments {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>