<div id="cnt-col1"> <!-- Start #cnt-col1 -->
    <div id="nav-main"> <!-- Start #nav-main -->
        <ul>
            <li><a href="<?= $this->createUrl('/dashboard'); ?>">Startseite</a></li>
            <li><a href="<?= $this->createUrl('/account'); ?>">Kundenaccounts</a></li>
            <li><a href="<?= $this->createUrl('/user'); ?>">Nutzer</a></li>
            <li><a href="<?= $this->createUrl('/paymeyaccount'); ?>">PAYMEY-Konten</a></li>
            <li><a href="<?= $this->createUrl('/transaction/index', array('Transaction_sort' => 'created.desc')); ?>">Transaktionen</a></li>
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
            Search
        </div>
        <!-- End .wrapper -->

    </div>
    <!-- End #cnt-content -->

</div> <!-- End #cnt-col2 -->