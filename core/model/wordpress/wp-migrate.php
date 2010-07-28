<?php

ini_set('max_execution_time',120);

/**
 * xPDO Wordpress to MODx Migration Code
 * Author James Ehly (devtrench.com)
 *
 * This script uses xpdo to connect to modx and wordpress packages to migrate
 * data from a wordpress database to a modx database
 *
 * The code below may or may not work for your particular wordpress and MODx install.
 * It should be used as a reference point, and you should customize it to your
 * specific needs, but I hope that most general cases are covered.
 *
 * This script is intended to be run on a new install of MODx Revolution.  If
 * you are using an existing MODx Revo install then the script will probably
 * work but might have some unexpected results. So, backup your data first, and
 * use at your own risk.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @author James Ehly <james@devtrench.com>
 * @copyright Copyright 2010, James Ehly
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License v2
 *
 * @todo figure out post authors - add WP users as MODx users, not sure what to do about passwords if more than md5 is used
 * @todo add all post meta options as template variables and associate data with them
 * @todo import to github and specify what features this release has and roadmap future releases
 * @todo add categories for migrated content
 * @todo test on fresh install
 *
 */

################################################################################
# Configuration
################################################################################

/**
 * a flag to turn this script on and off
 */
$can_migrate = true;

/**
 * Wordpress Database settings
 *
 * $wp_database_host     string database hostname
 * $wp_database_charset  string database character set
 * $wp_database_name     string database name
 * $wp_database_prefix   string database table prefix
 * $wp_database_username string database username
 * $wp_database_password string database password
 */
$wp_database_host     = 'localhost';
$wp_database_charset  = 'utf-8';
$wp_database_name     = 'wordpress';
$wp_database_prefix   = 'wp_';
$wp_database_username = 'root';
$wp_database_password = '';

/**
 * template ids to use during import
 * if you would like to have different templates for posts and pages you can
 * specify that below, if not they will default to the default template id
 * if the templates don't exist they will be created.  The default template id
 * must be set.
 */
$default_template_id = 1;
$post_template_id = 4;
$page_template_id = 5;

/**
 * $post_document_parent
 * the MODx document parent id, or array of values (if the page needs to be
 * created) for WP posts. If set to 0 the parent will be the document root.
 * If the id does not exist, a document will be created.
 *
 * integer or array (see modResource for possible values)
 * example array: array('pagetitle'=>'Blog','context_key'=>'web')
 * !! don't forget the context_key or your pages won't show up in your context
 */
$post_document_parent = array(
        'pagetitle'=>'Blog',
        'alias'=>'blog',
        'published'=>1,
        'template'=>$default_template_id,
        'context_key'=>'web');

/**
 * $page_document_parent
 * the modx document parent id, or array of values (if the page needs to be
 * created) for WP pages. If set to 0, the parent will be the document root.
 * If the id does not exist, a document will be created.
 *
 * integer or array (see modResource for possible values)
 * example array: array('pagetitle'=>'Blog','context_key'=>'web')
 */
$page_document_parent = 0;

/**
 * the name of the template variable that you want to use for your categories.
 * If it doesn't exist, it will be created. Leave blank if you don't want to
 * import categories
 */
$categories_tv = 'Tags';

/**
 * $empty_tables
 * if set to true, the tables that will be updated are emptied first.
 */
$empty_tables = true;

################################################################################

if (!$can_migrate) die('Migration cannot be processed, this script is off.');
if (!is_int($default_template_id)) die('The default template id must be set. Check that $default_template_id is set and is an integer.');

// Include the xpdo and modx classes
include ('../../xpdo/xpdo.class.php');
include ('../../model/modx/modx.class.php');

// Instantiate a new modx object.  MODx inherits from xpdo so we can use it
// like an xpdo object, but it has the extra functions needed for saving content.
// Thanks to Shaun McCormick for writing docs on this.
$modx = new modX();
$modx->initialize('web');

// Add the Quip package
$can_migrate_comments = $modx->addPackage( 'quip', '../../components/quip/model/',
        $modx->db->config['table_prefix'] );

// Now instantiate a new xpdo object and add our wordpress package.  This gives
// us the ability to make queries on the wordpress database as an xpdo object.
$wp = new xPDO('mysql:host=' . $wp_database_host .
                ';dbname=' . $wp_database_name .
                ';charset=' . $wp_database_charset,
        $wp_database_username,
        $wp_database_password );

$can_migrate_wp = $wp->addPackage('wordpress','../',$wp_database_prefix);

if (!$can_migrate_wp) die('Wordpress Package could not be loaded.');


/**
 * during migrations where you need to try, try and try again to get it right,
 * it's easier to truncate the tables here instead of doing it manually.
 * setting $empty_tables to true will delete data from the following tables.
 */
if($empty_tables)
{
  if ($can_migrate_comments)
  {
    $modx->db->query('TRUNCATE ' . $modx->getFullTableName('quip_comments'));
    $modx->db->query('TRUNCATE ' . $modx->getFullTableName('quip_comments_closure'));
  }
  $modx->db->query('TRUNCATE ' . $modx->getFullTableName('site_content'));
  $modx->db->query('TRUNCATE ' . $modx->getFullTableName('site_templates') . 'WHERE id != 1');
  $modx->db->query('TRUNCATE ' . $modx->getFullTableName('site_tmplvars'));
  $modx->db->query('TRUNCATE ' . $modx->getFullTableName('site_tmplvar_contentvalues'));
  $modx->db->query('TRUNCATE ' . $modx->getFullTableName('site_tmplvar_templates'));
}

// first set up the document parents
$post_parent = setupParent($post_document_parent, 'Post');
if ($post_parent === false)
  die('There was an error setting up the post parent.
       Check your configuration value for $post_document_parent');

$page_parent = setupParent($page_document_parent, 'Page');
if (!$page_parent === false)
  die('There was an error setting up the page parent.
       Check your configuration value for $page_document_parent');

// set up our default templates in an array
if (!empty($default_template_id))
  $templates['default'] = $default_template_id;
if (!empty($post_template_id))
  $templates['post'] = $post_template_id;
if (!empty($page_template_id))
  $templates['page'] = $page_template_id;


// now check that the templates exist
foreach($templates as $template_name => $template_id)
{
  $template = $template_name . '_template';
  if(!empty($template_id) && !$$template = $modx->getObject('modTemplate',$template_id))
  {
    $$template = $modx->newObject('modTemplate');
    $data = array(
            'id' => $post_template_id,
            'templatename' => 'Auto Generated ' . ucwords($template_name) . ' Template',
            'content' => '',
    );
    $$template->fromArray($data,'',true);
    $$template->save();
  }
}



// now add the category TV
if(!empty($categories_tv) && is_null($category_tv = $modx->getObject('modTemplateVar',array('name'=>$categories_tv))))
{
  $category_tv = $modx->newObject('modTemplateVar');
  $data = array(
          'name' => $categories_tv,
          'caption' => $categories_tv,
          'type' => 'text',
  );
  $category_tv->fromArray($data);
  $category_tv->save();
  $category_tv_id = $category_tv->get('id');

  foreach($templates as $template_name => $template_id)
  {
    if($template_id)
    {
      $tv_link = $modx->newObject('modTemplateVarTemplate');
      $tv_link->set('templateid',$template_id);
      $tv_link->set('tmplvarid',$category_tv_id);
      $tv_link->set('rank',1);
      $tv_link->save();
    }
  }
}



// set up all wp postmeta options up as template variables
$criteria = $wp->newQuery('Postmeta');
$criteria->groupby('meta_key');
$criteria->sortby('meta_key','ASC');
$postmetas = $wp->getCollection('Postmeta',$criteria);

foreach ($postmetas as $meta)
{
  // create each meta tv
  $meta_tv = $modx->newObject('modTemplateVar');
  $data = array(
          'name' => $meta->get('meta_key'),
          'caption' => $meta->get('meta_key'),
          'type' => 'textarea',
  );
  $meta_tv->fromArray($data);
  $meta_tv->save();
  $meta_tv_id = $meta_tv->get('id');
  $meta_tv_ids[$meta->get('meta_key')] = $meta_tv->get('id');
 
  // link the postmeta tvs to the templates
  foreach($templates as $template_name => $template_id)
  {
    if($template_id)
    {
      $tv_link = $modx->newObject('modTemplateVarTemplate');
      $tv_link->set('templateid',$template_id);
      $tv_link->set('tmplvarid',$meta_tv_id);
      $tv_link->set('rank',1);
      $tv_link->save();
    }
  }
}

// get all wordpress posts.  Isn't this so easy?
$posts = $wp->getCollection('Posts');

$post_count = 0;
$comment_count = 0;

/**
 * post and page migration -----------------------------------------------------
 *
 * iterate over each post and create a new modResource object, mapping our post
 * fields to our wordpress fields
 */
foreach($posts as $post)
{
  $resource = '';
  $template_id = '';
  $type = $post->get('post_type');

  switch($type)
  {
    case 'post':
      $parent = $post_parent;
      $document_type = 'document';
      $template_id = $post_template_id;
      break;
    case 'page':
      $parent = $post->get('post_parent');
      $parent = (!empty($parent)) ? $parent : $page_parent;
      $document_type = 'document';
      $template_id = $page_template_id;
      break;
    case 'attachment':
      $document_type = 'attachment';
      break;
    case 'revision':
      $document_type = 'revision';
      break;
    default:
  }

  if ($document_type == 'document')
  {
    $resource = $modx->newObject('modResource');
    $data = array(
            'id'=>$post->get('ID'),
            'content'=>$post->get('post_content'),
            'pagetitle'=>$post->get('post_title'),
            'context_key'=>'web',
            'alias'=>$post->get('post_name'),
            'published'=> ($post->get('post_status') == 'publish') ? 1 : 0,
            'pub_date'=> ($post->get('post_status') == 'publish') ? $post->get('post_date') : 0,
            'parent' => $parent,
            'richtext'=>0,
            'template'=> (empty($template_id)) ? $default_template_id : $template_id,
    );
    $resource->fromArray($data,'',true);

    // call the save function which inserts our object record into the database.
    $resource->save();
    $post_count++;
    $res_id = $resource->get('id');
  }

  /**
   * categories migration ------------------------------------------------------
   *
   * categories use a template variable to store categories.  This is a tag
   * based structure combines wordpress categories and tags into one field
   */
  if(!empty($categories_tv) && is_object($resource))
  {
    $term_relationsips = array();
    $term_taxonomies = array();
    $terms = array();

    $term_relationsips = $post->getMany('TermRelationships');
    if (!is_array($term_relationsips)) continue;

    foreach($term_relationsips as $tr)
    {
      $term_taxonomies[] = $tr->getOne('TermTaxonomys');
    }
    if (!is_array($term_taxonomies)) continue;

    foreach($term_taxonomies as $tt)
    {
      $term = $tt->getOne('Terms');
      $terms[] = $term->get('name');
    }

    // if categories exist add it to the templatevar for this resource
    if (count($terms) > 0)
    {
      $terms = join(',',$terms);
      $tv = $modx->newObject('modTemplateVarResource');
      $tv->set('tmplvarid',$category_tv_id);
      $tv->set('contentid',$res_id);
      $tv->set('value',$terms);
      $tv->save();
    }

  }

  /**
   * post meta migration -------------------------------------------------------
   */
  $postmetas = '';
  $criteria = $wp->newQuery('Postmeta');
    $criteria->where(array(
            'post_id' => $post->get('ID'),
    ));
  $postmetas = $wp->getCollection('Postmeta',$criteria);
  if (is_array($postmetas))
  {
    foreach($postmetas as $meta)
    {
      $tv = $modx->newObject('modTemplateVarResource');
      $tv->set('tmplvarid',$meta_tv_ids[$meta->get('meta_key')]);
      $tv->set('contentid',$res_id);
      $tv->set('value',$meta->get('meta_value'));
      $tv->save();
    }
  }

  /**
   * comment migration ---------------------------------------------------------
   *
   * comments are handled by quip - so you must have that package installed
   * in order to import comments
   */
  if ($can_migrate_comments)
  {
    // get wp comments that are related to this post, sorted how we need them
    // Thanks BobRay for showing me how to do this
    $criteria = $wp->newQuery('Comments');
    $criteria->where(array(
            'comment_post_ID' => $post->get('ID'),
    ));
    $criteria->sortby('comment_ID','ASC');

    $comments = $post->getMany('Comments',$criteria);
    if (!is_null($comments))
    {
      foreach($comments as $comment)
      {
        $quip = $modx->newObject('quipComment');
        $comment_data = array(
                'id'=>$comment->get('comment_ID'),
                'thread'=>$post->get('post_title') . '_' . $post->get('ID'),
                'parent'=>$comment->get('comment_parent'),
                'author'=>$comment->get('user_id'),
                'body'=>$comment->get('comment_content'),
                'name'=>$comment->get('comment_author'),
                'email'=>$comment->get('comment_author_email'),
                'website'=>$comment->get('comment_author_url'),
                'ip'=>$comment->get('comment_author_ip'),
                'createdon'=>$comment->get('comment_date'),
                'resource'=>$res_id, // here's where the comment is joined to the post
        );
        $quip->fromArray($comment_data,'',true);
        $quip->save();
        $comment_count++;
      }
    }
  }
}

/**
 * Processing is now finished. Echo the number of posts inserted.
 */
echo $post_count . ' post' . (($post_count == 1) ? '' : 's') . ' added. ' . $comment_count . ' comment' . (($comment_count == 1) ? '' : 's') . " added.\n";
echo "If you are done with migrating posts you should remove this file or set \$can_migrate to false so this page can't be executed in the future.\n";




/**
 * creates a parent resource for posts and pages
 *
 * input integer | array (parent values), string (container name)
 * returns integer or false
 */
function setupParent($parent, $type='Undefined')
{
  global $wp,$modx;

  // if the parent is 0 return true
  if ($parent === 0)
  {
    return $parent;
  }

  // if the parent is an integer, get the resource
  if (is_int($parent))
  {
    $parent_resource = $modx->getObject('modResource',$parent);
  }

  // if the parent already exists return true
  if(is_object($parent_resource))
  {
    return $parent;
  }

  // if the parent is null (resource not found), or the parent is an array,
  // create the resource
  if (is_null($parent_resource) || is_array($parent))
  {
    if (is_int($parent))
      $parent = array(
        'id'=>$parent,
        'pagetitle'=>$type . ' Container',
        'published'=>1,
        'context_key'=>'web'
      );
    $resource = $modx->newObject('modResource');
    $resource->fromArray($parent,'',true);
    $resource->save();
    return $resource->get('id');
  }
  else
  {
    // don't know what happened so fail
    return false;
  }
}

?>
