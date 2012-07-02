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
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */  
 
/**
 * Request Controller is dispatched by the Dispatcher if the view value in $_GET
 * is either "request" or "requests".
 * 
 * This controller is responsible for viewing the "request" and saving a request
 * 
 * @see ComBaseControllerService
 *
 * @category   Example
 * @package    Com_Invite
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */
 class ComInviteControllerRequest extends ComBaseControllerService
 {  
    /**
     * Read action. This action is executed when view in $_GET is "request" sinular
     * 
     * @param KCommandContext $context The KControllerAbstract::execute command chain context
     * 
     * @return mixed
     */
    protected function _actionRead(KCommandContext $context)
    {  
        //we don't do anything here. this is just to show
        //an example of an action
        return parent::_actionRead($context);   
    }
    
    /**
     * Add action. This action is executed from _actionPost but when the entity doesn't
     * exists and it needs to create an entity. Once entity is created, it is 
     * returned
     * 
     * @param KCommandContext $context The KControllerAbstract::execute command chain context
     * 
     * @return ComInviteDomainEntityRequest
     */    
    protected function _actionAdd(KCommandContext $context)
    {
       $entity = parent::_actionAdd($context);
              
       //now lets set the meta
       $meta   = $context->data->meta;
       
       //set the meta       
       $entity->setValue($meta);
    }
 }
 