<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            [ 'label' => 'Branchs',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=branches%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=branches%2Fcreate']
                ],
            ],
            [ 'label' => 'Companies',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=companies%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=companies%2Fcreate']
                ],
            ],
            [ 'label' => 'Departments',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=departments%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=departments%2Fcreate']
                ],
            ],
            [ 'label' => 'Customers',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=customers%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=customers%2Fcreate']
                ],
            ],
            [ 'label' => 'Emails',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=emails%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=emails%2Fcreate']
                ],
            ],
            [ 'label' => 'Events',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=events%2Findex']
                ],
            ],
            [ 'label' => 'Locations',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=locations%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=locations%2Fcreate']
                ],
            ],
            [ 'label' => 'Po',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=po%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=po%2Fcreate']
                ],
            ],
            [ 'label' => 'PoItem',
                'items' => [
                    ['label' => 'index', 'url' => 'index.php?r=po-item%2Findex'],
                    ['label' => 'create', 'url' => 'index.php?r=po-item%2Fcreate']
                ],
            ],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <form method="post" action="http://localhost:8080/index.php?r=site%2Flanguage" >
            <?php
            foreach(Yii::$app->params['languages'] as $key => $language){
                echo '<span name="lang" class="language" id ="'.$key.'" value="fa">'.$language.' | </span>';
            }
            ?>
            </form>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();