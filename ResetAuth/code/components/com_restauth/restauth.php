<?php 

print ComAppDispatcher::getInstance()->dispatch( KRequest::get('get.view','cmd','sessions') );
?>