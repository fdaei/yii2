<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">
            <?= Yii::t('app','Welcome') ?> tooo yii2
        </p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div id="poll">
                <h3>Do you like PHP ?</h3>
                <form>
                    Yes: <input type="radio" name="vote" value="0" onclick="getVote(this.value)"><br>
                    No: <input type="radio" name="vote" value="1" onclick="getVote(this.value)">
                </form>
            </div>

        </div>

    </div>
</div>
