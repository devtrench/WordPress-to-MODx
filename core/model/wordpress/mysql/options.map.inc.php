<?php
$xpdo_meta_map['Options']= array (
  'package' => 'wordpress',
  'table' => 'options',
  'fields' => 
  array (
    'option_id' => NULL,
    'blog_id' => 0,
    'option_name' => '',
    'option_value' => NULL,
    'autoload' => 'yes',
  ),
  'fieldMeta' => 
  array (
    'option_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'blog_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'option_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '64',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
    ),
    'option_value' => 
    array (
      'dbtype' => 'longtext',
      'phptype' => 'string',
      'null' => false,
    ),
    'autoload' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => 'yes',
    ),
  ),
);
