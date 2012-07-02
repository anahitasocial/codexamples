<?php defined('KOOWA') or die; ?>

<module position="sidebar-a">
<?php
//create an empty column in the sidebar-a so the form 
//won't be too large
?>
</module>
<?php 
//Uses bootstrap form tags http://twitter.github.com/bootstrap/base-css.html#forms

//the FormValidator is a mootools behavior for validating the form
//https://github.com/anutron/mootools-bootstrap/

//Note the data-validator attribuets of the input fields
?>
<?php
//@route() creates URL using the passed. It uses the current view and layout if not
//specified
//@see LibBaseViewAbstract::getRoute()
?>
<form action="<?=@route()?>" data-behavior="FormValidator" method="post">
    <fieldset>
        <legend><?= @text('Invite Form')?></legend>
        
        <div class="control-group">
            <label class="control-label"><?= @text('Name') ?></label>
            <div class="controls">
                <input data-validators="required" class="input-xxlarge" name="name" value="" size="50" maxlength="255" type="text">
            </div>        
        </div>
        <div class="control-group">
            <label class="control-label"><?= @text('Email') ?></label>
            <div class="controls">
                <input data-validators="required validate-email" class="input-xxlarge" name="email" value="" size="50" maxlength="255" type="text">
            </div>        
        </div>
        <div class="control-group">
            <label class="control-label"><?= @text('Description') ?></label>
            <div class="controls">
                <textarea data-validators="required minLength:30" class="input-xxlarge" rows=10 name="description" value="" size="50" maxlength="255"></textarea>                
            </div>        
        </div>
        <?php
            //the following fields are stored as a key/value pair in the database
            //in the meta column. The input name needs to be wrapped with meta[$name]
        ?>
        <div class="control-group">
            <label class="control-label"><?= @text('How did you hear about us') ?></label>
            <div class="controls">
                <input data-validators="required" class="input-xxlarge" name="meta[hear_about_us]" value="" size="50" maxlength="255" type="text">                
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><?= @text('What oher software do you use') ?></label>
            <div class="controls">
                <input data-validators="required" class="input-xxlarge" name="meta[other_software]" value="" size="50">                
            </div>        
        </div>        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?= @text('Send Request') ?></button>
        </div>
    </fieldset>
</form>