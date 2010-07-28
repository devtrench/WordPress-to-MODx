xPDO Wordpress to MODx Migration Code
=====================================
**Author James Ehly (http://www.devtrench.com)**

This script uses xpdo to migrate data from a wordpress database to a 
modx database.  So far, post and page content, categories and tags, and 
postmeta data is migrated.  Categories and tags are migrated as tags in 
template variables, postmetas are migrated into template variables. The
script does not migrate authors/users, plugins, templates or themes.

The code may or may not work for your particular version of 
WordPress and MODx. I've tested it on WordPress 2.9 and MODx 2.0 pl.
It should be used as a reference point, and you should customize it to 
your specific needs, but I hope that most general cases are covered.

IMPORTANT
---------

This script is intended to be run on a new install of MODx Revolution.  If
you are using an existing MODx Revo install then the script will probably
work but might have some unexpected results. So, backup your data first, and
use at your own risk.  BY DEFAULT THE SCRIPT DELETES ALL THE CONTENT IN 
THE TABLES IT UPDATES! If you don't want this to happen, make sure you set
$empty_tables to false.  I highly recommend running this script on a 
development version of your website (which you'll probably want to do
anyway since there will be quite a bit of cleanup work to do).

Read the configuration section of core/model/wordpress/wp-migrate.php 
for the other configuration options.

Installation and Use
--------------------

Simply copy the files into your MODx install, configure the options in
core/model/wordpress/wp-migrate.php and run it from the command line or
browser.  If running from the command line, navigate to the directory
wp-migrate.php is in and run "php wp-migrate.php".