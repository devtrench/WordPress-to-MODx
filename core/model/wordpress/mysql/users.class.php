<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/users.class.php');
class Users_mysql extends Users {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>