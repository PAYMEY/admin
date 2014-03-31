    <div id="login">
        <div class="wrapper fixed"><!-- Start .wrapper -->
            <div class="row fixed"> <!-- Start .row -->
                <div class="col25">
                    &nbsp;
                </div>
                <div class="col50 style1 main">
                    <div>
                        <h3 class="header">PAYMEY Administration &ndash; Log-in </h3>
                        <p>Bitte geben Sie Ihre Kennung und Ihr Passwort ein: <br /></p>

                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'loginForm',
                            //'enableAjaxValidation' => true,
                        )); ?>

                        <div class="row"> <!--Start .row -->
                            <div class="col33">
                                <!--<label for="inputId1">Kennung:</label>-->
                                <?= $form->labelEx($loginFormModel, 'username'); ?>
                            </div>
                            <div class="col66">
                                <!--<input type="text" value="" id="inputId1" name="inputId1" />-->
                                <?= $form->textField($loginFormModel, 'username'); ?>
                            </div>
                        </div> <!-- End .row -->
                        <div class="row"> <!--Start .row -->
                            <div class="col33">
                                <!--<label for="inputId2">Passwort</label>-->
                                <?= $form->labelEx($loginFormModel, 'password'); ?>
                            </div>
                            <div class="col66">
                                <!--<input type="password" value="" id="inputId2" name="inputId2" />-->
                                <?= $form->passwordField($loginFormModel, 'password'); ?>
                            </div>
                        </div> <!-- End .row -->
                        <div class="row"> <!--Start .row -->
                            <div class="col33">
                                &nbsp;
                            </div>
                            <div class="col66">
                                <!--<label><input type="checkbox" id="inputId3" name="inputId3" />Angemeldet bleiben</label>-->
                                <label><?= $form->checkBox($loginFormModel, 'rememberMe', array('class' => 'auto')); ?> Angemeldet bleiben</label>
                            </div>
                        </div> <!-- End .row -->
                        <div class="row"> <!--Start .row -->
                            <div class="col33">
                                &nbsp;
                            </div>
                            <div class="col66 marg-t">
                                <button class="btn large" id="submit">
                                    Anmelden
                                </button>
                            </div>
                        </div> <!-- End .row -->
                        <p><br/></p>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div> <!-- End .row -->
        </div><!-- End .wrapper -->
    </div>