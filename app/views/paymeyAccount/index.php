<div id="cnt-col1"> <!-- Start #cnt-col1 -->
    <div id="nav-main"> <!-- Start #nav-main -->
        <ul>
            <li><a href="<?= $this->createUrl('/dashboard'); ?>">Startseite</a></li>
            <li><a href="<?= $this->createUrl('/account'); ?>">Kundenaccounts</a></li>
            <li><a href="<?= $this->createUrl('/user'); ?>">Nutzer</a></li>
            <li class="active">
                <a href="<?= $this->createUrl('/paymeyaccount'); ?>">PAYMEY-Konten</a>
                <ul>
                    <li><a href="<?= $this->createUrl('/paymeyaccount/index',array('status'=>PaymeyAccount::STATUS_ACCOUNT_APPROVED)); ?>">Nicht aktivierte Konten anzeigen</a></li>
                </ul>
            </li>
            <a href="<?= $this->createUrl('/transaction/index', array('Transaction_sort' => 'created.desc')); ?>">Transaktionen</a>
            <li><a href="<?= $this->createUrl('/default/logout'); ?>">Abmelden</a></li>
        </ul>
    </div>
    <!-- End #nav-main -->
</div> <!-- End #cnt-col1 -->

<div id="cnt-col2"> <!-- Start #cnt-col2 -->

    <div id="cnt-content"> <!-- Start #cnt-content -->
        <div id="header">
            <div class="row"> <!-- Start .row -->
                <div class="row fixed"> <!-- Start .row.fixed -->
                    <div class="col6">
                        <a href="#" class="btn back main"><i></i></a>
                    </div>

                    <div class="col38 search main">
                        <input type="text" name="inputId1" id="inputId1" value=""/><a href="suche.php" class="btn search main"><i></i></a>
                    </div>
                </div>
                <!-- End .row.fixed -->
            </div>
            <!-- End .row -->
        </div>

        <div class="wrapper"><!-- Start .wrapper -->
            <table class="tablestyle1">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th><?= $pmaIdSortingLink; ?></th>
                        <th><?= $pmaNameSortingLink; ?></th>
                        <th><a href="#" class="sort up active">Kundenaccount<i></i></a></th>
                        <th><a href="#" class="btn tableaction plus"><i></i></a></th>
                    </tr>
                </thead>
                <tbody>
                <?php $this->widget('zii.widgets.CListView', array(
                    'dataProvider' => $pmaDataProvider,
                    'itemView' => '_pmaList',
                    'sorterHeader' => '',
                )); ?>
                </tbody>
            </table>
        </div>
        <!-- End .wrapper -->

    </div>
    <!-- End #cnt-content -->

</div> <!-- End #cnt-col2 -->