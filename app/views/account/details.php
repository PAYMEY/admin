<?php
/* @var $accountModel Account */
$accountLink = $this->createUrl('/account/details', array('accountId' => $accountModel->id));
$accountOwnerName = $accountModel->getAccountOwnerName();
?>
<div id="cnt-col1"> <!-- Start #cnt-col1 -->
    <div id="nav-main"> <!-- Start #nav-main -->
        <?php $this->widget('AdminMenuWidget'); ?>
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
        <div class="wrapper fixed"><!-- Start .wrapper -->
            <div class="row fixed"> <!-- Start .row -->
                <div class="col100">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="#">PAYMEY</a></li>
                            <li class="active"><a href="<?= $accountLink; ?>">Kundenaccount <?= $accountOwnerName; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end .row -->
            <div class="row fixed summary"> <!-- Start .row -->
                <div class="col66 style1">
                    <div>
                        <h1>Kundenaccount <?= $accountOwnerName; ?></h1>
                        <strong>Kundenaccount-ID:</strong> <?= $accountModel->id; ?><br/>
                        <strong>Besitzer:</strong> <?= $accountModel->owner->firstname . ' ' . $accountModel->owner->lastname; ?><br/>
                        <strong>E-Mail:</strong> <a href="mailto:<?= $accountModel->owner->email; ?>"><?= $accountModel->owner->email; ?></a><br/>
                        <strong>Status:</strong> <?= Yii::t('models', 'account.status.'.$accountModel->status); ?><br/>
                        <strong>Erstellt am:</strong> <?= date('d.m.Y', $accountModel->created); ?><br/>
                    </div>
                </div>
                <div class="col33 style2">
                    <div>
                        <h3 class="">Aktionen:</h3>
                        <h6><a href="#" class="symbol delete" onclick="document.getElementById('myDialog').style.visibility='visible'; document.getElementById('overlay').style.visibility='visible'"><i></i>Kundenaccount löschen</a></h6>
                        <!--
                        <h6><a href="nutzer-anlegen.php" class="symbol add"><i></i>Neuen Nutzer anlegen</a></h6>
                        <h6><a href="adresse-anlegen.php" class="symbol add"><i></i>Neue Adresse anlegen</a></h6>
                        <h6><a href="transaktion-erzeugen.php" class="symbol add"><i></i>Transaktion erzeugen</a></h6>
                        -->
                    </div>
                </div>
            </div>

            <div class="row fixed"> <!-- Start .row -->
                <div class="col100">
                    <div class="tabs">
                        <ul>
                            <li><a href="#tab1">Benutzer</a></li>
                            <li><a href="#tab2">PAYMEY-Konten</a></li>
                            <li><a href="#tab3">Adressen</a></li>
                            <li><a href="#tab4">Kundenaccountdaten bearbeiten</a></li>
                        </ul>

                        <div class="tab-content" id="tab1">
                            <table class="">
                                <?php $this->widget('zii.widgets.CListView', array(
                                    'dataProvider' => $userDataProvider,
                                    'itemView' => '_userList',
                                    'sorterHeader' => '',
                                )); ?>
                            </table>
                        </div>
                        <div class="tab-content" id="tab2">
                            <table class="">
                                <?php $this->widget('zii.widgets.CListView', array(
                                'dataProvider' => $pmaDataProvider,
                                'itemView' => '_pmaList',
                                'sorterHeader' => '',
                            )); ?>
                            </table>
                        </div>

                        <div class="tab-content" id="tab3">
                            <table class="">
                                <tr>
                                    <td><strong><a href="adressdetails.php">Franz Almsick, Manfredstraße 32, 80501 Braunschweig, Deutschland</a></strong></td>
                                </tr>

                                <tr>
                                    <td><strong><a href="adressdetails.php">Franz Almsick, Opelstraße 188, 55532 Halbstadt, Deutschland</a></strong></td>
                                </tr>

                                <tr>
                                    <td><strong><a href="adressdetails.php">Almsick Faschingsartikel Gbr., Hohle Gasse 3, 45028 Schwippstedt, Deutschland</a></strong></td>
                                </tr>

                                <tr>
                                    <td><strong><a href="adressdetails.php">F. Almsick, Gerberstraße 5-11, 70255 Dammbruch, Deutschland</a></strong></td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-content" id="tab4">
                            <div class="row fixed"> <!-- Start .row -->
                                <div class="col16">
                                    <input type="text" value="52001022" id="inputId2" name="inputId2" disabled="disabled" onchange="document.getElementById('safe').className='info'"/>
                                    <label for="inputId2">Kundenaccount-ID</label>
                                </div>

                                <div class="col50">
                                    <input type="text" value="Franz Ferdinand" id="inputId3" name="inputId3" disabled="disabled" onchange="document.getElementById('safe').className='info'"/>
                                    <label for="inputId3">Besitzer</label>
                                </div>

                                <div class="col33">
                                    <input type="submit" id="safe" value="Speichern" onclick="document.getElementById('message3').style.visibility='visible';"/>
                                </div>
                            </div>
                            <!-- End .row -->
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