<?php if (count($localHours)) { ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th><?= lang('main::default.local.text_opening'); ?></th>
                <?php if ($hasDelivery) { ?>
                    <th><?= lang('main::default.local.text_delivery'); ?></th>
                <?php } ?>
                <?php if ($hasCollection) { ?>
                    <th><?= lang('main::default.local.text_collection'); ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($localHours as $day => $hours) { ?>
                <tr>
                    <td><?= $day; ?></td>
                    <?php foreach ($hours as $hour) { ?>
                        <?php if ($hour->type == 'delivery' AND !$hasDelivery) { ?>
                            <td><?= lang('sampoyigi.local::default.text_closed'); ?></td>
                        <?php } else if ($hour->type == 'collection' AND !$hasCollection) { ?>
                            <td><?= lang('sampoyigi.local::default.text_closed'); ?></td>
                        <?php } else if (!$hour->isEnabled()) { ?>
                            <td><?= lang('sampoyigi.local::default.text_closed'); ?></td>
                        <?php } else if ($hour->isOpenAllDay()) { ?>
                            <td><?= lang('sampoyigi.local::default.text_24h'); ?></td>
                        <?php } else { ?>
                            <td><?= sprintf(lang('sampoyigi.local::default.text_working_hour'), $hour->open, $hour->close); ?></td>
                        <?php } ?>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
