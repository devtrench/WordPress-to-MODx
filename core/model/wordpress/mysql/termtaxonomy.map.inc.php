<?php
$xpdo_meta_map['TermTaxonomy']= array (
  'package' => 'wordpress',
  'table' => 'term_taxonomy',
  'fields' => 
  array (
    'term_taxonomy_id' => NULL,
    'term_id' => 0,
    'taxonomy' => '',
    'description' => NULL,
    'parent' => 0,
    'count' => 0,
  ),
  'fieldMeta' => 
  array (
    'term_taxonomy_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'term_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'taxonomy' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '32',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'description' => 
    array (
      'dbtype' => 'longtext',
      'phptype' => 'string',
      'null' => false,
    ),
    'parent' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'count' => 
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
    'Terms' => 
    array (
      'class' => 'Terms',
      'local' => 'term_id',
      'foreign' => 'term_id',
      'cardinality' => 'one',
      'owner' => 'foriegn',
    ),
    'TermRelationship' => 
    array (
      'class' => 'TermRelationships',
      'local' => 'term_taxonomy_id',
      'foreign' => 'term_taxonomy_id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
