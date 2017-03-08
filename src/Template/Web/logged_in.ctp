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
        <a href="<?= $this->Url->build(['controller' => 'Web', 'action' => 'index']); ?>">logout</a>
    </div>
    <div class="row">
        <table>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>userId</td>
                <td><?= $userId ?></td>
            </tr>
            <tr>
                <td>displayName</td>
                <td><?= $displayName ?></td>
            </tr>
            <tr>
                <td>pictureUrl</td>
                <td><?= $pictureUrl ?></td>
            </tr>
            <tr>
                <td>statusMessage</td>
                <td><?= $statusMessage ?></td>
            </tr>
        </table>
    </div>
</body>
</html>

