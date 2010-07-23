<?php
$xpdo_meta_map['Postmeta']= array (
  'package' => 'wordpress',
  'table' => 'postmeta',
  'fields' => 
  array (
    'meta_id' => NULL,
    'post_id' => 0,
    'meta_key' => NULL,
    'meta_value' => NULL,
  ),
  'fieldMeta' => 
  array (
    'meta_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'post_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'meta_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'index' => 'index',
    ),
    'meta_value' => 
    array (
      'dbtype' => 'longtext',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
