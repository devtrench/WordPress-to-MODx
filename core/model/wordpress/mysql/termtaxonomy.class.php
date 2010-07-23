<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/termtaxonomy.class.php');
class TermTaxonomy_mysql extends TermTaxonomy {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>