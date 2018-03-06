<?php foreach ($locationsList as $location) { ?>
    <?php
    $openingStatus = $location->workingScheduleInstance('opening')->getStatus();
    $deliveryStatus = $location->workingScheduleInstance('delivery')->getStatus();
    $collectionStatus = $location->workingScheduleInstance('collection')->getStatus();
    $openingTime = $location->workingScheduleInstance('opening')->getOpenTime();
    $hasDelivery = $location->hasDelivery();
    $hasCollection = $location->hasCollection();
    $distance = $location->calculateDistance($userPosition);
    $deliveryMinutes = $location->deliveryMinutes();
    $deliveryTime = $location->workingScheduleInstance('delivery')->getOpenTime();
    $collectionMinutes = $location->collectionMinutes();
    $collectionTime = $location->workingScheduleInstance('collection')->getOpenTime();
    ?>
    <div class="panel panel-local">
        <div class="panel-body">
            <div class="row">
                <div class="box-one col-xs-12 col-sm-5">
                    <img class="img-responsive pull-left"
                         src="<?= $location->getThumb(['height' => 90, 'width' => 90]); ?>">
                    <dl>
                        <dd><h4><?= $location->location_name; ?></h4></dd>
                        <dd>
                            <span class="text-muted"><?= format_address($location->getAddress()); ?></span>
                        </dd>
                        <?php if ($distance) { ?>
                        <dd>
                            <span class="text-muted"><?= $distance; ?> <?= $distanceUnit; ?></span>
                        </dd>
                        <?php } ?>
                    </dl>
                </div>
                <div class="clearfix visible-xs wrap-bottom"></div>
                <div class="clearfix visible-xs border-top wrap-bottom"></div>
                <div class="col-xs-6 col-sm-4">
                    <dl>
                        <?php if ($openingStatus == 'open') { ?>
                            <dt><?= lang('sampoyigi.local::default.text_is_opened'); ?></dt>
                        <?php }
                        else if ($openingStatus == 'opening') { ?>
                            <dt class="text-muted"><?= sprintf(lang('sampoyigi.local::default.text_opening_time'), $openingTime); ?></dt>
                        <?php }
                        else { ?>
                            <dt class="text-muted"><?= lang('sampoyigi.local::default.text_closed'); ?></dt>
                        <?php } ?>
                        <dd class="text-muted">
                            <?php if ($hasDelivery) { ?>
                                <?php if ($deliveryStatus == 'open') { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_delivery_time_info'), sprintf(lang('sampoyigi.local::default.text_in_minutes'), $deliveryMinutes)); ?>
                                <?php }
                                else if ($deliveryStatus == 'opening') { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_delivery_time_info'), sprintf(lang('sampoyigi.local::default.text_starts'), $deliveryTime)); ?>
                                <?php }
                                else { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_delivery_time_info'), lang('sampoyigi.local::default.text_is_closed')); ?>
                                <?php } ?>
                            <?php } ?>
                        </dd>
                        <dd class="text-muted">
                            <?php if ($hasCollection) { ?>
                                <?php if ($collectionStatus == 'open') { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_collection_time_info'), sprintf(lang('sampoyigi.local::default.text_in_minutes'), $collectionMinutes)); ?>
                                <?php }
                                else if ($collectionStatus == 'opening') { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_collection_time_info'), sprintf(lang('sampoyigi.local::default.text_starts'), $collectionTime)); ?>
                                <?php }
                                else { ?>
                                    <?= sprintf(lang('sampoyigi.local::default.text_collection_time_info'), lang('sampoyigi.local::default.text_is_closed')); ?>
                                <?php } ?>
                            <?php } ?>
                        </dd>
                    </dl>
                </div>
                <div class="col-xs-6 col-sm-3 text-right">
                    <dl>
                        <?php if ($showReviews) { ?>
                            <dd>
                                <div class="rating rating-sm text-muted">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star-half-o"></span>
                                    <span class="fa fa-star-o"></span>
                                    <span><?= sprintf(lang('sampoyigi.local::default.text_total_review'), $location->reviews_count); ?></span>
                                </div>
                            </dd>
                        <?php } ?>
                        <dd>
                            <a class="btn btn-primary"
                               href="<?= page_url('local/menus', ['location' => $location->permalink_slug]); ?>"><?= lang('sampoyigi.local::default.button_view_menu'); ?></a>
                        </dd>
                        <dd class="text-muted small">
                            <?php if (!$hasDelivery AND $hasCollection) { ?>
                                <?= lang('sampoyigi.local::default.text_only_collection_is_available'); ?>
                            <?php }
                            else if ($hasDelivery AND !$hasCollection) { ?>
                                <?= lang('sampoyigi.local::default.text_only_delivery_is_available'); ?>
                            <?php }
                            else if ($hasDelivery AND $hasCollection) { ?>
                                <?= lang('sampoyigi.local::default.text_offers_both_types'); ?>
                            <?php }
                            else { ?>
                                <?= lang('sampoyigi.local::default.text_offers_no_types'); ?>
                            <?php } ?>
                        </dd>
                    </dl>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
<?php } ?>
