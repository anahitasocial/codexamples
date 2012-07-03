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
* @see ComBaseControllerResource
* @see LibBaseControllerBehaviorExecutable
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
class ComInviteControllerRequest extends ComBaseControllerResource
{  
    /** 
     * Constructor.
     *
     * @param KConfig $config An optional KConfig object with configuration options.
     * 
     * @return void
     */ 
    public function __construct(KConfig $config)
    {
        parent::__construct($config);
        
    }
    
    /**
     * Browse action. This action is executed when view in $_GET is "requests" pluralize
     * 
     * This action is called when showing a list of requests
     * 
     * @see ComBaseControllerResource::_actionBrowse
     * 
     * @param KCommandContext $context The KControllerAbstract::execute command chain context
     * 
     * @return AnDomainEntitysetAbstract
     */    
    protected function _actionBrowse(KCommandContext $context)
    {
        //the parent browse return an entitset of
        //requets
        $entityset = parent::_actionBrowse($context);
        
        //get the search term from the controller
        //request object
        $keyword   = $this->getRequest()->search;
        //if exists then filter entities
        if ( $keyword ) {
            $entityset->where('email','LIKE','%'.$keyword.'%');
        }
    }
    
    /**
     * Read action. This action is executed when view in $_GET is "request" sinular
     * 
     * 
     * @param KCommandContext $context The KControllerAbstract::execute command chain context
     * 
     * @return AnDomainEntityAbstract
     */
    protected function _actionRead(KCommandContext $context)
    {
        //add a custom command to the toolabr
        $entity = parent::_actionRead($context);
        
        $this->getToolbar('request')
            ->addCommand('accept', array(
                'attribs' =>array(                    
                    'data-action'=> 'accept'
                 )
            ));
        
        return $entity;
    }
      
    /**
     * Accept action. Custom action to create a user from a request
     * 
     * @param KCommandContext $context The KControllerAbstract::execute command chain context
     * 
     * @return AnDomainEntityAbstract
     */
    protected function _actionAccept(KCommandContext $context)
    {
        $data   = $context->data;
        //the entity is automatically fetched by LibBaseControllerBehaviorIdentifiable 
        //controller behavior becuase 
        //the url contains a value for the $id.
        $entity = $data->entity;
        
        //method in the ComInviteDomainEntityRequest::createUser
        //if succesful, then delete the reuqest object after that 
        if ( $user = $entity->createUser() ) {
            //@TODO send an email to the user
            //delete the entity            
            $entity->delete();
        }
        
        //redirect back to the requests view
        $this->setRedirect('view=requests');
    }
            
    /**
     * Called by LibBaseControllerBehaviorExecutable controller behavior before
     * _actionAdd is executed, if it returns false then _actionAdd won't be execute.
     * 
     * Since we are not adding requests, we want to prevent the default add action
     * in ComBaseControllerResource 
     * 
     * @return boolean
     */
    public function canAdd()
    {
        return false;
    }
    
    /**
     * Called by LibBaseControllerBehaviorExecutable controller behavior before
     * _actionAdd is executed, if it returns false then _actionAdd won't be execute.
     * 
     * Since we are not editing requests, we want to prevent the default add action
     * in ComBaseControllerResource 
     * 
     * @return boolean
     */
    public function canEdit()
    {
        return false;   
    }    
}