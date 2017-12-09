<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Impressum';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-imprint">
	<h1><?= Html::encode($this->title) ?></h1>

	<h2>
		Ein Angebot von:<br>
	</h2>

	<p>
		<strong>Cyber Perikarp - Verein zur Förderung der Netzkultur</strong><br>
		℅ auskunftsbegehren.at<br>
		Wassertalweg 56/3<br>
		8670 Krieglach<br>
		Österreich
	</p>
	<p>
		Email: <a href="javascript:linkTo_UnCryptMailto('nbjmup;pggjdfAbvtlvogutcfhfisfo/bu');">office @ auskunftsbegehren . at</a><br>
		Telefon: <a href="tel:0043385528910">+43 3855 289 10</a> (Gesprächsannahme unzuverlässig)<br>
		Fax: +43 3855 289 10 - 10
	</p>
	<p>
		Vereinsregisternummer: 712531114<br>
		Datenverarbeitungsregister: 4016968<br>
		EU-Transparenz-Registernummer: 334990728439-25<br>
		D-U-N-S® Nummer: 300530810
	</p>
</div>

<script type="text/javascript">
	<!--
		function UnCryptMailto(s) {
			var n=0;
			var r="";
			for(var i=0; i < s.length; i++) {
				n=s.charCodeAt(i);
				if (n>=8364) {n = 128;}
				r += String.fromCharCode(n-(1));
			}
			return r;
		}
	function linkTo_UnCryptMailto(s)	{
		location.href=UnCryptMailto(s);
	}
	// -->
</script>
