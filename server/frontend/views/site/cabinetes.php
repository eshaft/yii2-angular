<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 23.10.17
 * Time: 12:36
 */
?>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <img src="<?=$user['photo_max']?>">
            <div class="caption">
                <h3><?=$user['first_name']?> <?=$user['last_name']?></h3>
                <p><a href="/site/quit" class="btn btn-primary" role="button">Выйти</a></p>
            </div>
        </div>
    </div>
</div>


<?php if($cabinetes): ?>
<div class="list-group">
    <?php foreach ($cabinetes as $cab): ?>
        <a href="/site/cabinet?account_id=<?=$cab['account_id']?>" class="list-group-item"><?=$cab['account_name']?></a>
    <?php endforeach; ?>
</div>
<?php endif?>

