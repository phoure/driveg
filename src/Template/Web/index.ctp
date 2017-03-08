<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
</head>
<body>
<div class="subheader"></div>
<div class="container">
    <div class="row">
        <a href="<?= $this->Url->build(['controller' => 'Web', 'action' => 'login']); ?>">
            <image src="/img/btn_login_base.png"></image>
        </a>
    </div>
</div>
</body>
</html>
