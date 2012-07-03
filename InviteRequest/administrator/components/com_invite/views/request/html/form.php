<?php defined('KOOWA') or die('Restricted access');?>

<?php JHTML::_('behavior.calendar');?>

<div class="col width-50">
    <form action="<?= @route('&id='.$entity->id)?>" method="post" class="-koowa-form" >
    <fieldset class="adminform">
        <legend><?= JText::_( 'Request Detail' ); ?></legend>
        
        <table class="admintable">
            <tr>
                <td width="100" align="right" class="key">
                    <?= @text('Id') ?>
                </td>
                <td>
                    <?= $entity->id ?>
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">
                    <?= @text('Name') ?>
                </td>
                <td>
                    <?= $entity->name ?>
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">
                    <?= @text('Email') ?>
                </td>
                <td>
                    <?= $entity->email ?>
                </td>
            </tr>
            <tr>
                <td width="100" align="right" class="key">
                    <?= @text('Description') ?>
                </td>
                <td>
                    <?= $entity->description ?>
                </td>
            </tr>  
            <?php foreach($entity->meta as $key => $value) : ?>
            <tr>
                <td width="100" align="right" class="key">
                    <?= @text($key) ?>
                </td>
                <td>
                    <?= $value ?>
                </td>
            </tr>
            <?php endforeach; ?>          
        </table>        
    </fieldset>
    </form>

</div>