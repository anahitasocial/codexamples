<?php defined('JPATH_BASE') or die();
/**
 * @version		$Id$
 * @category	Anahita
 * @package		PlgProfileGroupcustomprofile
 * @copyright	Copyright (C) 2008 - 2010 rmdStudio Inc. and Peerglobe Technology Inc. All rights reserved.
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link     	http://www.anahitapolis.com
 */

/**
 * PlgProfileGroupcustomprofile Plugin
 *
 * @category	Anahita
 * @package		PlgProfileGroupcustomprofile
 */
class PlgProfileGroupcustomprofile extends PlgProfileAbstract
{
	/**
	 * Called when group profile is saved
	 *
	 * @param  KEvent $config
	 * @return void
	 */
	public function onSave(KEvent $config)
	{	    
	    //the KEvent has access to the current profile/actor object	    	    
	    $actor   = $config->actor;
	    $profile = $config->profile;
	    	    
	    //if it's a group, then save the custom group information
	    if ( is($actor,'ComGroupsDomainEntityGroup') )
	    {
	        $data    = (array) KRequest::get('post.groupcustomprofile', 'string');
	        
	        //get a profile recrod 
	        //the repository method findOrCreate either fins an existing one or creates on 
	        //if it doesn't exists
	        //to see the profile information, you can do $profile->inspect();
	        $profile = repos('com.groupcustomprofile.domain.entity.profile')->findOrCreate(array('actorId'=>$actor->id));
	        $profile->setData($data);
	        $profile->save();
	    }
	}

	/**
	 * Called when a profile is showing
	 *
	 * @param  KEvent $config
	 * @return void
	 */
	public function onDisplay(KEvent $config)
	{
	    //the KEvent has access to the current profile/actor object
	    $actor   = $config->actor;
	    $profile = $config->profile;
	    
	    //if it's a group, then show the custom group information
	    if ( is($actor,'ComGroupsDomainEntityGroup') )
	    {	        
	        //get the profile if exists if not then return an empty profile
	        //an empty profile has empty values
	        $profile = repos('com.groupcustomprofile.domain.entity.profile')->findOrCreate(array('actorId'=>$actor->id));
	        //if a profile is created we don't want it accidently save 
	        //so we are resting its state
	        //to see the profile information, you can do $profile->inspect();
	        $profile->reset();
	        
	        $section1['Custom Field 1'] = $profile->customfield1;
	        $section1['Custom Field 2'] = $profile->customfield2;
	        $section1['Custom Field 3'] = $profile->customfield3;
	        $section2['Custom Field 4'] = $profile->customfield4;
	        $section3['Custom Field 5'] = $profile->customfield5;
	        	        
	        $config->profile->append(array(
	             'Section 1' => $section1,
	             'Section 2' => $section2,
	             'Section 3' => $section3
	        ));	        
	    }		
	}

	/**
	 * Called when a editing an actor
	 *
	 * @param  KEvent $config
	 * @return void
	 */
	public function onEdit(KEvent $config)
	{	   
	    //the KEvent has access to the current profile/actor object	     		
	    $actor   = $config->actor;
	    $profile = $config->profile;
	    
	    //if it's a group, then add the custom group information
	    if ( is($actor,'ComGroupsDomainEntityGroup') )
	    {
	        //html helper.
	        $html      = KFactory::get('lib.anahita.app.template.helper.html');
	        $section1  = array();
	        $section2  = array();
	        $section3  = array();	        
	        
	        //get the profile if exists if not then return an empty profile
	        //an empty profile has empty values
	        $profile = repos('com.groupcustomprofile.domain.entity.profile')->findOrCreate(array('actorId'=>$actor->id));
	        //if a profile is created we don't want it accidently save
	        //so we are resting its state
	        //to see the profile information, you can do $profile->inspect();
	        $profile->reset();
	        	        
	        //creating the fields using the html template helper
	        //we namespace the textfields with groupcustomprofile that way to ensure
	        //no conflict occurs
	        $section1['Custom Field 1'] = $html->textfield('groupcustomprofile[customfield1]', $profile->customfield1);
	        $section1['Custom Field 2'] = $html->textfield('groupcustomprofile[customfield2]', $profile->customfield2);
	        $section1['Custom Field 3'] = $html->textfield('groupcustomprofile[customfield3]', $profile->customfield3);
	        $section2['Custom Field 4'] = $html->textfield('groupcustomprofile[customfield4]', $profile->customfield4);
	        $section3['Custom Field 5'] = $html->textfield('groupcustomprofile[customfield5]', $profile->customfield5);
	    
	        $config->profile->append(array(
	             'Section 1' => $section1,
	             'Section 2' => $section2,
	             'Section 3' => $section3
	        ));
	    }
	}		
}