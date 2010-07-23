<?php
$xpdo_meta_map['Terms']= array (
  'package' => 'wordpress',
  'table' => 'terms',
  'fields' => 
  array (
    'term_id' => NULL,
    'name' => '',
    'slug' => '',
    'term_group' => 0,
  ),
  'fieldMeta' => 
  array (
    'term_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'pk',
      'generated' => 'native',
    ),
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'slug' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '200',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
    ),
    'term_group' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'TermTaxonomy' => 
    array (
      'class' => 'TermTaxonomy',
      'local' => 'term_id',
      'foreign' => 'term_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
