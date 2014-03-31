<div id="cnt-col1"> <!-- Start #cnt-col1 -->
    <div id="nav-main"> <!-- Start #nav-main -->
        <ul>
            <li class="active"><a href="<?= $this->createUrl('/dashboard'); ?>">Startseite</a></li>
            <li><a href="#">Kundenaccounts</a></li>
            <li><a href="#">Nutzer</a></li>
            <li><a href="#">PAYMEY-Konten</a></li>
            <li><a href="#">Transaktionen</a></li>
            <li><a href="<?= $this->createUrl('/default/logout'); ?>">Abmelden</a></li>
        </ul>
    </div>
    <!-- End #nav-main -->
</div> <!-- End #cnt-col1 -->

<div id="cnt-col2"><!-- Start #cnt-col2 -->
    <div id="cnt-content"><!-- Start #cnt-content -->
        <div id="header">
            <div class="row"> <!-- Start .row -->
                <div class="row fixed"> <!-- Start .row.fixed -->
                    <div class="col6">
                        <a href="#" class="btn back main"><i></i></a>
                    </div>

                    <div class="col38 search main">
                        <input type="text" name="inputId1" id="inputId1" value=""/><a href="#" class="btn search main"><i></i></a>
                    </div>
                </div>
                <!-- End .row.fixed -->
            </div>
            <!-- End .row -->
        </div>
        <div class="wrapper fixed"><!-- Start .wrapper -->
            <div class="row fixed "> <!-- Start .row -->
                <div class="col66">
                    <div>
                        <h1>Willkommen im PAYMEY Administrationsbereich</h1>
                        Verwenden Sie die Stichwortsuche im oberen Bereich des Bildschirms, um in allen Datensätzen nach Nutzern, E-Mail-Adressen,
                        Transaktionen usw. zu suchen. Auf der Ergebnisseite können Sie Ihre Suche anschließend verfeinern. Die Navigation Links bietet Ihnen Direktugriff auf die wichtigsten Tabellen, Funktionen und
                        Informationen.<br/><br/>
                    </div>
                </div>
                <div class="col33 style1">
                    <div>
                        <h3 class="header">Das erfordert Ihre Aufmerksamkeit:</h3>
                        <h6><a href="#" class="symbol transaction"><i></i>Offene Transaktionen: <?= $statistics['openTransactions']; ?></a></h6>
                        <!--<h6><a href="#" class="symbol user"><i></i>Nicht identifizierte Nutzer: 312</a></h6>-->
                        <h6><a href="#" class="symbol user"><i></i>Nicht aktivierte Benutzer: <?= $statistics['unverifiedUsers']; ?></a></h6>
                        <h6><a href="#" class="symbol group"><i></i>Nicht aktivierte Paymey Konten: <?= $statistics['unverifiedPaymeyAccounts']; ?></a></h6>
                    </div>
                </div>
            </div>
            <!-- end .row -->
            <div class="row fixed"> <!-- Start .row -->
                <div class="col100">
                    <div class="tabs">
                        <ul>
                            <li><a href="#tab1">Neue Transaktionen</a></li>
                            <li><a href="#tab2">Neue Nutzerkonten</a></li>
                            <li><a href="#tab3">Statistiken</a></li>
                        </ul>
                        <div class="tab-content" id="tab1">
                            <table class="tablestyle1">

                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Typ</th>
                                    <th>Datum</th>
                                    <th>Betrag</th>
                                    <th>Abbuchung</th>
                                    <th>Zahlender</th>
                                    <th>Empfänger</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $this->widget('zii.widgets.CListView', array(
                                    'dataProvider' => $transactionDataProvider,
                                    'itemView' => '_transactionList',
                                )); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-content" id="tab2">
                            <table class="tablestyle1">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Name</th>
                                        <th>ID</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $this->widget('zii.widgets.CListView', array(
                                        'dataProvider' => $accountDataProvider,
                                        'itemView' => '_accountList',
                                    )); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-content" id="tab3">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Zeitraum</th>
                                        <th>Neue Kundenaccounts</th>
                                        <th>Neue Geräte</th>
                                        <th>Transaktionen</th>
                                        <th>Erfolgreiche Transaktionen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Heute (<?= $today; ?>)</td>
                                        <td><?= $statistics['newAccountsToday']; ?></td>
                                        <td><?= $statistics['newDevicesToday']; ?></td>
                                        <td><?= $statistics['newTransactionsToday']; ?></td>
                                        <td><?= $statistics['newSuccessfulTransactionsToday']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Gestern (<?= $yesterday; ?>)</td>
                                        <td><?= $statistics['newAccountsYest']; ?></td>
                                        <td><?= $statistics['newDevicesYest']; ?></td>
                                        <td><?= $statistics['newTransactionsYest']; ?></td>
                                        <td><?= $statistics['newSuccessfulTransactionsYest']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Vorgestern (<?= $dbfYest; ?>)</td>
                                        <td><?= $statistics['newAccountsDbfYest']; ?></td>
                                        <td><?= $statistics['newDevicesDbfYest']; ?></td>
                                        <td><?= $statistics['newTransactionsDbfYest']; ?></td>
                                        <td><?= $statistics['newSuccessfulTransactionsDbfYest']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Insgesamt</td>
                                        <td><?= $statistics['accounts']; ?></td>
                                        <td><?= $statistics['devices']; ?></td>
                                        <td><?= $statistics['transactions']; ?></td>
                                        <td><?= $statistics['successfulTransactions']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .row -->
        </div>
        <!-- End .wrapper -->
    </div>
<!-- End #cnt-content -->
</div> <!-- End #cnt-col2 -->
<script>
    $(".tabs").tabs();
</script>