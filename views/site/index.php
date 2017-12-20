<?php

/* @var $this yii\web\View */

$this->title = 'Her mit den Daten! Auskunftsbegehren leicht gemacht.';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Her mit den Daten!</h1>

        <p class="lead">Auskunftsbegehren leicht gemacht.</p>
    </div>

    <div class="body-content">
        <p>Unsere Daten werden laufend gesammelt, verarbeitet und ausgewertet.</p>

        <ul>
            <li>
                Wer sammelt eigentlich welche Daten? 
            </li>
            <li>
                Wie kann ich wissen, ob die über mich gespeicherten Daten korrekt sind? 
            </li>
            <li>
                Kann ich das löschen lassen?
            </li>
        </ul>

        <p>Um diese Fragen zu beantworten gibt es hier die Möglichkeit, ganz einfach den ersten Schritt zu gehen und bei den Datensammlern auf Basis des Datenschutzgesetzes (§ 26 DSG) das <strong>garantierte und kostenfreie* Recht auf Auskunft</strong> auch durchzusetzen.</p>

        <p>* Ein Mal pro Jahr kann an jede Stelle - egal ob Behörde oder Unternehmen - ein Auskunftsbegehren ohne Verrechnung von Kosten gestellt werden.</p>

        <h2>Wie beginnen? Was tun?</h2>

        <p>
            Einfach auf der Seite <a href="<?= yii\helpers\Url::to(['auskunft/index']); ?>">Auskunft verlangen!</a> Name und Anschrift einfügen, die Empfänger des Auskunftsbegehrens auswählen und PDF erzeugen.<br>
            Ausdrucken, unterschreiben, kopierten Ausweis beilegen und per Post oder Fax abschicken.
        </p>
        <p>
            Wir haben 300 der beliebtesten Datensammler zum Auswählen - fein säuberlich kategorisiert. Wem das noch nicht genug ist bzw. wenn wir die Liste ergänzen sollen: Mail an <a href="javascript:linkTo_UnCryptMailto('nbjmup;pggjdfAbvtlvogutcfhfisfo/bu');">office @ auskunftsbegehren . at</a> (oder du verwendest das <a href="<?= yii\helpers\Url::to(['auskunft/suggest']); ?>">Formular</a>) und wir nehmen Deinen Empfänger in unsere Liste auf. 

            Wir speichern Deine Daten nicht (außer während der Erstellung des PDFs um dieses zu erzeugen), das PDF ist dann 72 Stunden abrufbar (inklusive Deiner Daten im Briefkopf) und wird anschließend gelöscht.
        </p>

        <p>
            <a href="<?= yii\helpers\Url::to(['site/faq']); ?>">
                Noch Fragen?
            </a>
        </p>

        <p>
            <a href="<?= yii\helpers\Url::to(['auskunft/index']); ?>">
                Alles klar?
            </a>
        </p>
    </div>
</div>
