<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/postmeta.class.php');
class Postmeta_mysql extends Postmeta {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>