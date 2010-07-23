<?php
$xpdo_meta_map['Usermeta']= array (
  'package' => 'wordpress',
  'table' => 'usermeta',
  'fields' => 
  array (
    'umeta_id' => NULL,
    'user_id' => 0,
    'meta_key' => NULL,
    'meta_value' => NULL,
  ),
  'fieldMeta' => 
  array (
    'umeta_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'user_id' => 
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
