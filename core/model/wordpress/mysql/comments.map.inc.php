<?php
$xpdo_meta_map['Comments']= array (
  'package' => 'wordpress',
  'table' => 'comments',
  'fields' => 
  array (
    'comment_ID' => NULL,
    'comment_post_ID' => 0,
    'comment_author' => NULL,
    'comment_author_email' => '',
    'comment_author_url' => '',
    'comment_author_IP' => '',
    'comment_date' => '0000-00-00 00:00:00',
    'comment_date_gmt' => '0000-00-00 00:00:00',
    'comment_content' => NULL,
    'comment_karma' => 0,
    'comment_approved' => '1',
    'comment_agent' => '',
    'comment_type' => '',
    'comment_parent' => 0,
    'user_id' => 0,
    'comment_subscribe' => 'N',
  ),
  'fieldMeta' => 
  array (
    'comment_ID' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'comment_post_ID' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'comment_author' => 
    array (
      'dbtype' => 'tinytext',
      'phptype' => 'string',
      'null' => false,
    ),
    'comment_author_email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_author_url' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_author_IP' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_date' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'comment_date_gmt' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
      'index' => 'index',
    ),
    'comment_content' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'comment_karma' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'comment_approved' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => '1',
      'index' => 'index',
    ),
    'comment_agent' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_parent' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'user_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'comment_subscribe' => 
    array (
      'dbtype' => 'enum',
      'precision' => '\'Y\',\'N\'',
      'phptype' => 'string',
      'null' => false,
      'default' => 'N',
    ),
  ),
  'aggregates' => 
  array (
    'Users' => 
    array (
      'class' => 'Users',
      'local' => 'user_id',
      'foreign' => 'ID',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
