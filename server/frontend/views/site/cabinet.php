<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 23.10.17
 * Time: 12:59
 */
?>
<h3><?=$cabinet['account_name']?></h3>
<p><a href="/site/cabinetes" class="btn btn-primary" role="button">К списку кабинетов</a></p>
<?php if($campaigns): ?>

    <div class="list-group">
        <?php foreach ($campaigns as $cam): ?>
            <a href="/site/campaign?account_id=<?=$account_id?>&campaign_id=<?=$cam['id']?>" class="list-group-item"><?=$cam['name']?></a>
        <?php endforeach; ?>
    </div>
<?php endif?>
