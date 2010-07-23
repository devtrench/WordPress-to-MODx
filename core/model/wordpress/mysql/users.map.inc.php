<?php
$xpdo_meta_map['Users']= array (
  'package' => 'wordpress',
  'table' => 'users',
  'fields' => 
  array (
    'ID' => NULL,
    'user_login' => '',
    'user_pass' => '',
    'user_nicename' => '',
    'user_email' => '',
    'user_url' => '',
    'user_registered' => '0000-00-00 00:00:00',
    'user_activation_key' => '',
    'user_status' => 0,
    'display_name' => '',
  ),
  'fieldMeta' => 
  array (
    'ID' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'user_login' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '60',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
    ),
    'user_pass' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '64',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'user_nicename' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'user_email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'user_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'user_registered' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'user_activation_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '60',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'user_status' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'display_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '250',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'composites' => 
  array (
    'Usermeta' => 
    array (
      'class' => 'Usermeta',
      'local' => 'ID',
      'foreign' => 'user_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
