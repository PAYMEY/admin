<?php
/* @var $userModel User */
/* @var $accountModel Account */
$accountLink = $this->createUrl('/account/details', array('accountId' => $accountModel->id));
$accountOwnerName = $accountModel->getAccountOwnerName();
$userLink = $this->createUrl('/user/details', array('userId' => $userModel->id, 'accountId' => $accountModel->id));
$userName = $userModel->firstname . ' ' . $userModel->lastname;
$userToggleStatusLink = $this->createUrl('/user/toggleStatus', array('userId' => $userModel->id));
$userToggleStatusLinkText = ($userModel->status == User::STATUS_BLOCKED) ? Yii::t('admin','activateUser') : Yii::t('admin', 'blockUser');
$userDeleteLink = $this->createUrl('/user/delete', array('userId' => $userModel->id));
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
                            <li><a href="<?= $accountLink; ?>">Kundenaccount <?= $accountOwnerName; ?></a></li>
                            <li class="active"><a href="<?= $userLink; ?>">Nutzer <?= $userName; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end .row -->
            <div class="row fixed summary"> <!-- Start .row -->
                <div class="col66 style1">
                    <div>
                        <h1>Nutzer <?= $userName; ?></h1>
                        <strong>Nutzer-ID:</strong> <?= $userModel->id; ?><br/>
                        <strong>E-Mail:</strong> <a href="mailto:<?= $userModel->email; ?>"><?= $userModel->email; ?></a><br/>
                        <strong>Status:</strong> <?= Yii::t('models', 'user.status.'. $userModel->status); ?><br/>
                        <strong>Erstellt am:</strong> <?= date('d.m.Y', $userModel->created); ?><br/>
                    </div>
                </div>
                <div class="col33 style2">
                    <div>
                        <h3 class="">Aktionen:</h3>
                        <h6><a href="<?= $userDeleteLink; ?>" class="symbol delete deleteConfirm"><i></i>Nutzer löschen</a></h6>
                        <h6><a href="<?= $userToggleStatusLink; ?>" class="symbol status"><i></i><?= $userToggleStatusLinkText; ?></a></h6>
                    </div>
                </div>
            </div>

            <div class="row fixed"> <!-- Start .row -->
                <div class="col100">
                    <div class="tabs">
                        <ul>
                            <li><a href="#tab1">Nutzerdaten bearbeiten</a></li>
                            <!-- <li><a href="#tab2">Kundenidentifikation</a></li> -->
                        </ul>
                        <div class="tab-content" id="tab1">
                            <?php
                            $form = $this->beginWidget(
                                'CActiveForm',
                                array(
                                    'id' => 'user-detail-form',
                                    'enableClientValidation' => true,
                                    'htmlOptions' => array('autocomplete' => 'off'),
                                    'clientOptions' => array('successCssClass' => 'noop'),
                                    //'action' => $this->createUrl('/user/update', array('userId'=>$userModel->id,'accountId'=>$accountModel->id))
                                )
                            );
                            ?>
                            <div class="row fixed"> <!-- Start .row -->
                                <div class="col16">
                                    <select id="inputId2" name="inputId2" onchange="document.getElementById('safe').className='info'">
                                        <option value="1">TODO</option>
                                        <option value="2" selected="selected">TODO</option>
                                    </select>
                                    <label for="inputId2">Anrede</label>
                                </div>

                                <div class="col25">
                                    <?= $form->textField($userModel, 'firstname', array('onchange' => "document.getElementById('save').className='info'")); ?>
                                    <?= HtmlHelper::activeLabelEx($userModel, 'firstname', array('class' => ''));?>
                                    <span class="help-inline"></span>
                                </div>

                                <div class="col25">
                                    <?= $form->textField($userModel, 'lastname', array('onchange' => "document.getElementById('save').className='info'")); ?>
                                    <?= HtmlHelper::activeLabelEx($userModel, 'lastname', array('class' => ''));?>
                                    <span class="help-inline"></span>
                                </div>

                                <div class="col33">
                                    <input type="submit" id="save" value="Speichern" />
                                </div>
                            </div>
                            <div class="row fixed"> <!-- Start .row -->
                                <div class="col50">
                                    <input type="text" onchange="document.getElementById('safe').className='info'" name="inputId5" id="inputId5" value="TODO">
                                    <label for="inputId5">Straße</label>
                                </div>
                                <div class="col16">
                                    <input type="text" onchange="document.getElementById('safe').className='info'" name="inputId6" id="inputId6" value="TODO">
                                    <label for="inputId6">Haus-Nr.</label>
                                </div>

                                <div class="col33">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row fixed"> <!-- Start .row -->
                                <div class="col16">
                                    <input type="text" onchange="document.getElementById('safe').className='info'" name="inputId7" id="inputId7" value="TODO">
                                    <label for="inputId7">PLZ</label>
                                </div>
                                <div class="col50">
                                    <input type="text" onchange="document.getElementById('safe').className='info'" name="inputId8" id="inputId8" value="TODO">
                                    <label for="inputId8">Stadt</label>
                                </div>

                                <div class="col33">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row fixed"> <!-- Start .row -->
                                <div class="col66">
                                    <select onchange="document.getElementById('safe').className='info'" name="inputId9" id="inputId9">
                                        <option value="1">TODO</option>
                                        <option value="2">Frankreich</option>
                                        <option value="2">Litauen</option>
                                    </select>
                                    <label for="inputId9">Land</label>
                                </div>

                                <div class="col33">
                                    &nbsp;
                                </div>
                            </div>
                            <!-- End .row -->
                            <?php $this->endWidget(); ?>
                        </div>
                        <div class="tab-content" id="tab2">

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
<div class="dialog" id="deleteConfirmDialog"><!-- Start .dialog -->
    <div class="header">
        <a href="#" class="btn close closeDeleteDialog"><i></i></a>
        <h3>Nutzer löschen</h3>
    </div>
    <div class="body">
        Sind Sie sicher, dass Sie diesen Nutzer löschen möchten?
    </div>
    <div class="footer">
        <a href="#" class="btn closeDeleteDialog">Nicht löschen</a> <a href="#" class="btn info" id="deleteConfirmLink">Löschen</a>
    </div>
</div><!-- End .dialog -->
<div id="overlay"></div>
<script>
    $('.tabs').tabs();
    PAYMEY.ADMIN.dialogs.init();
</script>