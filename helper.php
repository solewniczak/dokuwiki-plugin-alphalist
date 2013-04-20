<?php
/**
 * Plugin Now: Inserts a timestamp.
 * 
 * @license    GPL 3 (http://www.gnu.org/licenses/gpl.html)
 * @author     Szymon Olewniczak <szymon.olewniczak@rid.pl>
 */

// must be run within DokuWiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'syntax.php';

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class helper_plugin_alphalist extends dokuwiki_plugin
{
    function getMethods(){
      $result = array();
      $result[] = array(
	'name'   => 'parse',
	'desc'   => 'change dokuwiki syntax to html',
	'params' => array('string' => 'string'),
	'return' => array('content' => 'string'),
      );
      $result[] = array(
	'name'   => 'plain',
	'desc'   => 'convert dokuwiki syntax to plain text',
	'params' => array('string' => 'string'),
	'return' => array('plain' => 'string'),
      );
    }
    function parse($string)
    {
	$info = array();
	return p_render('xhtml',p_get_instructions($string),$info);
    }
    function plain($string)
    {
	$doku_inline_tags = array('**', '//', "''", '<del>', '</del>', ']]');
	$plain = str_replace($doku_inline_tags, '', $string);
	$req_link = '/\[\[(.*?\|)?/';
	$plain = preg_replace($req_link, '', $plain);
	return trim($plain);
    }
}

