<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/termrelationships.class.php');
class TermRelationships_mysql extends TermRelationships {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>