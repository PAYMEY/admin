<?php
$i = 1000;
foreach ($notifications as $n) {
    switch ($n['class']) {
        case 'error':
            $class = 'message error main';
            break;

        case 'warning':
            $class = 'message info main';
            break;

        case 'notice':
            $class = 'message info main';
            break;

        case 'success':
            $class = 'message success main';
            break;
    }

?>
<div id="message<?= $i; ?>" class="<?= $class; ?>" style="visibility: visible;">
    <div>
        <strong><i></i><?= $n['message'] ?></strong>
        <a onclick="document.getElementById('message<?= $i; ?>').style.visibility='hidden';" class="btn close"><i></i></a>
    </div>
</div>
<?php
}
?>
<div id="messageAjax" class="message info main">
    <div>
        <strong><i></i></strong>
        <a onclick="document.getElementById('messageAjax').style.visibility='hidden';" class="btn close"><i></i></a>
    </div>
</div>