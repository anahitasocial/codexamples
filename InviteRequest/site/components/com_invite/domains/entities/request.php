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
 * @subpackage Domain_Entity
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */  
 
/**
 * Requet entity object. It fetches its data from the table #__jos_invite_requests.
 * 
 * Its attributes are mapped to the #__jos_invite_requests columns
 * 
 * Since a request has non-normalized data, we can store them in the meta attribute
 * (meta column of #__jos_invite_requests table). We can use the 
 * @see LibBaseDomainBehaviorDictionariable behavior to help use save and retreive 
 * dictionary values from the meta attribute
 *
 * @category   Example
 * @package    Com_Invite
 * @subpackage Domain_Entity
 * @author     Arash Sanieyan <ash@anahitapolis.com>
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2010 rmdStudio Inc./Peerglobe Technology Inc
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @version    SVN: $Id: resource.php 11985 2012-01-12 10:53:20Z asanieyan $
 * @link       http://www.anahitapolis.com
 */ 
 class ComInviteDomainEntityRequest extends AnDomainEntityAbstract
 {
    /**
    * Initializes the default configuration for the object
    *
    * Called from {@link __construct()} as a first step of object instantiation.
    *
    * @param KConfig $config An optional KConfig object with configuration options.
    *
    * @return void
    */
    protected function _initialize(KConfig $config)
    {
        $config->append(array(
            'attributes' => array(
                'name'        => array('required'=>'true'),
                'description' => array('required'=>'true'),
                'email'       => array('format'=>'email'),
            ),
            'behaviors'  => array(
                'dictionariable'
             )
        ));

        parent::_initialize($config);
    }
        
    /**
     * Creates a person object from the request 
     * 
     * @return JUser
     */
    public function createUser()
    {    
        //create a randome username from the email
        $username = preg_replace('/@.*/','', $this->email).rand(0, 10000);
        //create a randome password 
        $password = uniqid();
        
        $user     = JUser::getInstance();
        $data     = array(
            'username' => $username,
            'name'     => $this->name,
            'password'  => $password,
            'password2' => $password, //Juser requires a confirmation password
            'email'    => $this->email.rand(0,100000)
        );
       
        $user->bind($data);
        
        return $user;
    }
 }