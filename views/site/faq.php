<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-faq">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Warum ist das so kompliziert?</h3>
        </div>
        <div class="panel-body">
            Panel content
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Welche Daten speichern wir?</h3>
        </div>
        <div class="panel-body">
            Bitte wirf einen Blick auf unsere <a href="<?= yii\helpers\Url::to(['site/privacy']); ?>">Datenschutzerklärung</a>.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cookies?</h3>
        </div>
        <div class="panel-body">
            Wir setzen zwei Cookies auf deinem Rechner. Einer ist ein Session Cookie, mit dem wir dich theoretisch wiedererkennen können, bis du deinen Browser schließt.
            Das tun wir aber nicht. Das musst du uns auch nicht glauben, sondern du kannst den kompletten Quellcode dieser Webanwendung, inklusive der Serverkonfiguration auch <a href="https://github.com/cyber-perikarp">auf GitHub einsehen</a>.
            Der zweite Cookie dient zum sogenannten <a href="https://de.wikipedia.org/wiki/Cross-Site-Request-Forgery">CSRF Schutz</a> und wird gelöscht wenn du den Browser schließt.
        </div>
    </div>
</div>