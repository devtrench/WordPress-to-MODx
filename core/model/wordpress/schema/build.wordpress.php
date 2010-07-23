<?php
/*
 * xPDO Wordpress to MODx Migration Code
 * Author James Ehly (devtrench.com)
 *
 * This code is part of the WP to MODx migration and should go in your
 * core/model/schema directory.  Simply run it from a web browser or cli and
 * it will create the wordpress schema from the database and all of the
 * xpdo objects in core/model/wordpress
 *
 * Once this is done we can run the wp2modx.php script that does the actual
 * data migration.
 *
 * @todo some manual intervention is needed to set up the table relationships we need
 *
 * Thanks to Jason Coward for posting how do set up a schema from a database:
 * http://modxcms.com/forums/index.php/topic,16562.0.html
 */

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tstart= $mtime;

//Customize this line based on the location of your script
include_once ('../../../xpdo/xpdo.class.php');

$xpdo= new xPDO('mysql:host=localhost;dbname=wordpress_devtrench','root','','wp_');

// Set the package name and root path of that package
$xpdo->setPackage('wordpress', XPDO_CORE_PATH . '../model/');

$xpdo->setDebug(true);

$manager= $xpdo->getManager();
$generator= $manager->getGenerator();

//Use this to create a schema from an existing database
//$xml= $generator->writeSchema(XPDO_CORE_PATH . '../model/schema/wordpress.mysql.schema.xml', 'wordpress', 'xPDOObject', 'wp_');

//Use this to generate classes and maps from your schema
// NOTE: by default, only maps are overwritten; delete class files if you want to regenerate classes
$generator->parseSchema(XPDO_CORE_PATH . '../model/wordpress/schema/wordpress.mysql.schema.xml', XPDO_CORE_PATH . '../model/');

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

echo "\nExecution time: {$totalTime}\n";
