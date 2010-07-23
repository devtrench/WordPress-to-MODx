<?php
$xpdo_meta_map['TermRelationships']= array (
  'package' => 'wordpress',
  'table' => 'term_relationships',
  'fields' => 
  array (
    'object_id' => 0,
    'term_taxonomy_id' => 0,
    'term_order' => 0,
  ),
  'fieldMeta' => 
  array (
    'object_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
    ),
    'term_taxonomy_id' => 
    array (
      'dbtype' => 'bigint',
      'precision' => '20',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'pk',
    ),
    'term_order' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
  ),
  'composites' => 
  array (
    'TermTaxonomys' => 
    array (
      'class' => 'TermTaxonomy',
      'local' => 'term_taxonomy_id',
      'foreign' => 'term_taxonomy_id',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
  'aggregates' => 
  array (
    'Post' => 
    array (
      'class' => 'Posts',
      'local' => 'object_id',
      'foreign' => 'ID',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
