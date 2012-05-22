<?php

/** 
 * LICENSE: ###LICENSE###
 * 
 * @category   Anahita
 * @package    Com_Restatuh
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id$
 * @link       http://www.anahitapolis.com
 */

/**
 * Sesssion Controller 
 * 
 * @category   Anahita
 * @package    Com_Restatuh
 * @subpackage Controller
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.anahitapolis.com
 */
class ComRestauthControllerSession extends ComAppControllerView
{    
    /**
     * Get action
     *
     * @return string
     */
    protected function _actionGet(KCommandContext $context)
    {
        $data = array();
        
        //return the session object          
        $data['session_id']   = JFactory::getSession()->getId();
        $data['session_name'] = JFactory::getSession()->getName();
        
        return $this->getView()->set('data', $data)->display();
    }

    /**
     * Create a session (login)
     *
     * @return string
     */
    protected function _actionPost(KCommandContext $context)
    {                
        global $mainframe;
        
        if ($return = JRequest::getVar('return', '', 'method', 'base64')) {
            $return = base64_decode($return);
            if (!JURI::isInternal($return)) {
                $return = '';
            }
        }
        
        $options = array();
        $options['remember'] = JRequest::getBool('remember', false);
        $options['return'] = $return;

        $credentials = array();
        $credentials['username'] = JRequest::getVar('username', '', 'method', 'username');
        $credentials['password'] = JRequest::getString('passwd', '', 'post', JREQUEST_ALLOWRAW);       
        //preform the login action
        $error = $mainframe->login($credentials, $options);
        
        if(!JError::isError($error))
        {
            return $this->execute('get', $context);           
        }
        else
        {
            $context->status = KHttpResponse::UNAUTHORIZED;
            
            $data['code']    = $error->getCode();
            $data['message'] = $error->getMessage();
            
            return $this->getView()->set('data', $data)->display();
        }
        
    }
        
    /**
     * Delete Session
     *
     * @return string
     */
    protected function _actionDelete(KCommandContext $context)
    {
        global $mainframe;
        
        //preform the logout action
        $mainframe->logout();
        
        return '';
    }
}