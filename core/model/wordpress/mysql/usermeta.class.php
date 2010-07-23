<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/usermeta.class.php');
class Usermeta_mysql extends Usermeta {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>