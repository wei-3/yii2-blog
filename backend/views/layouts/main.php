<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
//        ['label' => '首页', 'url' => ['/site/index']],
        ['label' => '用户管理','items'=>[
            ['label' => '用户列表', 'url' => ['/user/index']],
            ['label' => '添加用户', 'url' => ['/user/add']],
        ]],
        ['label' => '文章管理','items'=>[
            ['label' => '文章列表', 'url' => ['/article/index']],
            ['label' => '添加文章', 'url' => ['/article/add']],
        ]],
        ['label' => '评论管理','items'=>[
            ['label' => '评论列表', 'url' => ['/comment/index']],
            ['label' => '添加评论', 'url' => ['/comment/add']],
        ]],
        ['label' => '文章分类管理','items'=>[
            ['label' => '文章分类列表', 'url' => ['/article-category/index']],
            ['label' => '添加文章分类', 'url' => ['/article-category/add']],
        ]],
        ['label' => 'RBAC管理','items'=>[
            ['label' => '权限列表', 'url' => ['/rbac/index-permission']],
            ['label' => '添加权限', 'url' => ['/rbac/add-permission']],
            ['label' => '角色列表', 'url' => ['/rbac/index-role']],
            ['label' => '添加角色', 'url' => ['/rbac/add-role']],
        ]],
        ['label' => '菜单管理','items'=>[
            ['label' => '菜单列表', 'url' => ['/menu/index']],
            ['label' => '添加菜单', 'url' => ['/menu/add']],
        ]],
    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
