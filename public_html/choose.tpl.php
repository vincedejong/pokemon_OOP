<?php 
	$pokemons = getPokemons($database);
 ?>

<?php include 'header.tpl.php'; ?>

<div class='row'>
	<div class='small-10 medium-6 columns small-centered'>
		<form method="POST" action="index.php?p=battle">
			<input id='player_1' type="hidden" name="player_1" value="0">
			<input id='player_2' type="hidden" name="player_2" value="0">

			<?php foreach($pokemons as $pokemon){ ?>
				<div class='row'>
					<div class='small-12 columns pokemon-holder'>
						<h4><?php echo $pokemon['name']; ?></h4>
						<?php echo $pokemon['type']; ?>
						<div class='player' data-pokemon="<?php echo $pokemon['id'] ?>"></div>
					</div>
				</div>
			<?php } // End $pokemons foreach ?>
			Chosing: <span id='chosing'></span> <br />
			<input type="submit" value="Start">
		</form>
	</div>
</div>
	

<?php include 'footer.tpl.php'; ?>