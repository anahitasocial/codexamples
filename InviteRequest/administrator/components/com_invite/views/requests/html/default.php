<?php defined('KOOWA') or die('Restricted access'); ?>

<form action="index.php" method="get" class="adminForm">
    <input type="hidden" value="requests" name="view" />
    <input type="hidden" value="com_invite" name="option" />
    <table width="100%" class="mc-filter-table mc-first-table">
        <tr>
            <td class="mc-first-cell" width="100%">
                <?= @text( 'Filter' ); ?>:
                <input type="text" name="search" id="search" value="<?= empty($search) ? '' : $search ?>" class="text_area"  />
                <?= @html('button','Go')->onclick("this.form.submit()")   ?>
                <?= @html('button','Reset')->onclick("this.form.search.value='';this.form.submit();return false;")?>
            </td>
        </tr>
    </table>
</form>

<form action="<?= @route()?>" method="post" class="-koowa-grid">
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="action" value="" />
    <table class="adminlist mc-list-table mc-second-table" cellspacing="1">
        <thead>
            <tr>                
                <th width="1%"><?= @text('NUM'); ?></th>
                <th width="20%"><?= @helper('grid.sort', array('column'=>'person','sort'=>$sort)); ?></th>
                <th width="10%"><?= @helper('grid.sort', array('column'=>'email','sort'=>$sort)); ?></th>                
                <th width="1%"><?= @helper('grid.sort', array('column'=>'id','sort'=>$sort)); ?></th>
            </tr>
        </thead>
        
        <tbody>     
        <? $i = 0; $m = 0; ?>
        <? foreach ($requests as $request) : ?>
        <tr class="<?php echo 'row'.$m; ?>">
            <td align="center"><?= $i + 1; ?></td>
            <td>    
                <a href="<?=@route(array('view'=>'request','id'=>$request->id))?>">
                    <?= $request->name ?>
                </a>
            </td>
            <td align="center"><?= $request->email ?></td>
            <td align="center"><?= $request->id; ?></td>
        </tr>
        <? $i = $i + 1; $m = (1 - $m); ?>
        <? endforeach; ?>
        <?php if (!$requests->getTotal()) : ?>
            <tr>
                <td colspan="4" align="center">
                    <?= @text('There are no requests'); ?>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
        
        <tfoot>
            <tr>
                <td colspan="5">
                    <?= @helper('paginator.pagination', array('total'=>$requests->getTotal(), 'offset'=>$requests->getOffset(), 'limit'=>$requests->getLimit())) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</form>