<?php

/** 
 * LICENSE: Anahita is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 * 
 * @category   Example
 * @package    Com_Invite
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */  

/**
* This is the entry point to the component. This file is loaded by Anahita to 
* dispatch a resource within the component
*/

//gets the "view" from the $_GET hash. If it doesn't exist
//then use the default view "invite"
$view = KRequest::get('get.view','cmd', 'requests');

//Get the dispatcher object. The dispatcher object is used to dispatch a request
//to a resource (controller). The resource name is derived from the view value 
//in the $_GET hash object
$dispatcher = ComBaseDispatcher::getInstance();

//now we dispatch the resource (controller) within the component. and display the
//result 
print $dispatcher->dispatch($view);