<?php
require_once (strtr(realpath(dirname(dirname(__FILE__))), '\\', '/') . '/posts.class.php');
class Posts_mysql extends Posts {
    public function __construct(& $xpdo) {
        parent :: __construct($xpdo);
    }
}
?>