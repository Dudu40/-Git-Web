
<?php

$title='Accueil';
require 'header.php';

$url=$_SERVER['REQUEST_URI'];
$parfums=[
	'vanille'=>3,
	'fraise'=>1,
	'chocolat'=>2
];

$cornets=[
	'pot'=>2,
	'cornet'=>3
];

$supplements=[
	'pepites de chocolat'=>2,
	'chanitilly'=>3
];

$ingredients=[];
$total=0;


foreach(['parfum','supplement'] as $name){
	// si les parfums sont bien selectionnes
	if (isset($_GET[$name])){
		// cree le mot sans le dollar $$ liste est la variable de ce mot
		$liste=$name.'s';
		// on parcourt la liste de la catgorie parfum ou supplementif

		foreach ($_GET[$name] as $value){
			if(isset($$liste[$value])){
				$ingredients[]=$value;
				$total+=$$liste[$value];
			}
		}
		
	}
}

if (isset($_GET['cornet'])){
		// verifie le prix cornet existe dans le tableau
	$cornet=$_GET['cornet'];
	if(isset($cornets[$cornet])){
		$ingredients[]=$cornet;
		$total+=$cornets[$cornet];
	}	
}


function checkbox(string $name,string $value,array $data):string{
	$attribute='';
	// si la liste de parfum/cornet existe et que la valeur cherchée apparient a la liste
	if(isset($data[$name]) && in_array($value,$data[$name])){
		$attribute='checked';
	}
	return <<<HTML
		<input type="checkbox" name="{$name}[]" value="$value" attribute="$attribute">
HTML;
}

function radio(string $name,string $value,array $data):string{
	$attribute='';
	// si la liste de parfum/cornet existe et que la valeur cherchée apparient a la liste
	if(isset($data[$name]) && $value===$data[$name]){
		$attribute='checked';
	}
	return <<<HTML
		<input type="radio" name="{$name}" value="$value" attribute="$attribute">
HTML;


}


?>

<body>
<div class="blockPrincipal">

	<h4>Ma glace :</h4>
	<?php if ($ingredients!=null):?>
		<?php foreach ($ingredients as $ingredient):?>
			<li> 
				<a><?php echo $ingredient?></a>
			</li>
		<?php endforeach?>
	<?php else:?>
			Votre glace est vide
	<?php endif?>
	<strong> prix : <?= $total?></strong>

	<form action="<?php $url?>" method="GET">
		<h2>Vos parfums !</h2>
		<?php foreach ($parfums as $parfum => $prix):?>
			<div class="form-control">
				<label>
					<?=checkbox("parfum",$parfum,$_GET)?>
					<?php echo $parfum?> - <?php echo $prix?> $
				</label>
			</div>
		<?php endforeach?>

		<h2>Votre cornet !</h2>
		<div class="form-group">
			<?php foreach ($cornets as $cornet => $prix):?>
				<div class="form-control">
					<label>
						<?=radio("cornet",$cornet,$_GET)?>
						<?php echo $cornet?> - <?php echo $prix?> $
					</label>
				</div>
			<?php endforeach?>
		</div>

		<h2>Vos supplements !</h2>
		<div class="form-grop">
			<?php foreach ($supplements as $supplement => $prix):?>
				<div class="checkbox">
					<label>
						<?=checkbox("supplement",$supplement,$_GET)?>
						<?php echo $supplement?> - <?php echo $prix?> $
					</label>
				</div>
			<?php endforeach?></br>
		</div>

		<button type="submit" class="btn btn-primary">Valider ma glace</button>
	</form></br>

</div>
</body>

