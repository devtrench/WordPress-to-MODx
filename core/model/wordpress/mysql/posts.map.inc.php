<?php
$xpdo_meta_map['Posts']= array (
  'package' => 'wordpress',
  'table' => 'posts',
  'fields' => 
  array (
    'ID' => NULL,
    'post_author' => 0,
    'post_date' => '0000-00-00 00:00:00',
    'post_date_gmt' => '0000-00-00 00:00:00',
    'post_content' => NULL,
    'post_title' => NULL,
    'post_category' => 0,
    'post_excerpt' => NULL,
    'post_status' => 'publish',
    'comment_status' => 'open',
    'ping_status' => 'open',
    'post_password' => '',
    'post_name' => '',
    'to_ping' => NULL,
    'pinged' => NULL,
    'post_modified' => '0000-00-00 00:00:00',
    'post_modified_gmt' => '0000-00-00 00:00:00',
    'post_content_filtered' => NULL,
    'post_parent' => 0,
    'guid' => '',
    'menu_order' => 0,
    'post_type' => 'post',
    'post_mime_type' => '',
    'comment_count' => 0,
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
    'post_author' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'post_date' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'post_date_gmt' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'post_content' => 
    array (
      'dbtype' => 'longtext',
      'phptype' => 'string',
      'null' => false,
    ),
    'post_title' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'post_category' => 
    array (
      'dbtype' => 'int',
      'precision' => '4',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'post_excerpt' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'post_status' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => 'publish',
      'index' => 'index',
    ),
    'comment_status' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => 'open',
    ),
    'ping_status' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => 'open',
    ),
    'post_password' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'post_name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'to_ping' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'pinged' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'post_modified' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'post_modified_gmt' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => false,
      'default' => '0000-00-00 00:00:00',
    ),
    'post_content_filtered' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
    ),
    'post_parent' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'guid' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'menu_order' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'post_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '20',
      'phptype' => 'string',
      'null' => false,
      'default' => 'post',
      'index' => 'index',
    ),
    'post_mime_type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '100',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'comment_count' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'aggregates' => 
  array (
    'Users' => 
    array (
      'class' => 'Users',
      'local' => 'post_author',
      'foreign' => 'ID',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' => 
  array (
    'Comments' => 
    array (
      'class' => 'Comments',
      'local' => 'ID',
      'foreign' => 'comment_post_ID',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'PostMeta' => 
    array (
      'class' => 'Postmeta',
      'local' => 'ID',
      'foreign' => 'post_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'TermRelationships' => 
    array (
      'class' => 'TermRelationships',
      'local' => 'ID',
      'foreign' => 'object_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
