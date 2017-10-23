<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 23.10.17
 * Time: 13:18
 */
?>

<?php if($ads): ?>
    <h3><?=$cabinet['account_name']?></h3>
    <h4><?=$campaign['name']?></h4>
    <p><a href="/site/cabinet?account_id=<?=$account_id?>" class="btn btn-primary" role="button">К списку кампаний</a></p>
    <?php foreach ($ads as $ad): ?>
        <div class="row">
            <h4><?=$ad['name']?></h4>
            <div class="row">
                <div class="col-lg-6">
                    Название капании
                </div>
                <div class="col-lg-6">
                    <?=$campaign['name']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Дневной лимит
                </div>
                <div class="col-lg-6">
                    <?=$ad['day_limit']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Лимит объявления
                </div>
                <div class="col-lg-6">
                    <?=$ad['all_limit']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Цена за 1000 показов
                </div>
                <div class="col-lg-6">
                    <?=$ad['cpm'] / 100?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Статус
                </div>
                <div class="col-lg-6">
                    <?=$statuses[$ad['status']]?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Дата запуска
                </div>
                <div class="col-lg-6">
                    <?=$ad['start_time']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Дата остановки
                </div>
                <div class="col-lg-6">
                    <?=$ad['stop_time']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Рекламные площадки
                </div>
                <div class="col-lg-6">
                    <?=$ad_platforms[$ad['ad_platform']]?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Ограничение показов
                </div>
                <div class="col-lg-6">
                    <?=$ad['impressions_limit']?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Тематики
                </div>
                <div class="col-lg-6">
                    <?=$ad['category1_id']?> (<?=$ad['category2_id']?>)
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    Целевая аудитория
                </div>
                <div class="col-lg-6">
                    <?=$ad['category1_id']?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif?>
