<?php 

class Pokemon {

// Properties
	private	$name;
	protected	$damage;
	protected 	$hp;
	private $health;
	private $type;
	private $weakness;
	private $resistance;
	private $color;
	private $attacks;
// End properties

	public function __construct($pokemon){

		// Set pokemon properties if $pokemon is given
		if(!empty($pokemon)){
			$this->name 		= $pokemon['name'];
			$this->damage 		= $pokemon['damage'];
			$this->hp 			= $pokemon['hp'];
			$this->health 		= $pokemon['hp'];
			$this->type 		= $pokemon['type'];
			$this->weakness 	= $pokemon['weakness'];
			$this->resistance 	= $pokemon['resistance'];
			$this->color 		= $this->setColor($pokemon['type']);
			$this->attacks 		= array();

			// Check if there are any attacks
			if(!empty($pokemon['attacks'])){
				// Loop over attacks
				foreach($pokemon['attacks'] as $attack){
					// Create new array with attacks
					$this->attacks[$attack['name']] = ['name'=>$attack['name'], 'damage'=>$attack['damage'], 'type'=>$attack['type'], 'color'=>$this->setColor($attack['type'])];
				}
			}
			else {
				// Set default attack
				$this->attacks['tackle'] = ['name'=>'tackle', 'damage'=>10, 'type'=>'normal', 'color'=>$this->setColor('normal')];
			}
		}
	}

	public function setDamage(){
		return $this->damage;
	}

	public function __toString(){
		return json_encode($this);
	}

// Getters
	public function getHealth(){
		return $this->health;
	}

	public function getDamage(){
		return $this->damage;
	}

	public function getName(){
		return $this->name;
	}

	public function getColor(){
		return $this->color;
	}

	public function getHp(){
		return $this->hp;
	}

	public function getAttacks(){
		return $this->attacks;
	}

	public function getWeakness(){
		return $this->weakness;
	}

	public function getResistance(){
		return $this->resistance;
	}
// End getters

// Setters
	public function setColor($type){

		// loop over types
		switch($type){

			// set fire color
			case 'fire':
				return '#a3211a';
			break;

			// set water color
			case 'water':
				return '#4287f5';
			break;

			// set grass color
			case 'grass':
				return '#32a852';
			break;

			// set electric color
			case 'electric':
				return '#d4d266';
			break;

			// set normal color
			case 'normal':
				return '#96957a';
			break;
		}
		
	}

	public function setHealth($damage){

		$this->health = $this->health - $damage;

		if($this->health <= 0){
			$this->health = 0;
		}

		return $this->health;
	}
// End setters

// Methodes
	public function attack($attack, $enemy){
		// attack log
		$message 	= '';
		$effective 	= '';

		// attack log, attacks
		$message .= '<span style=\'color:blue;\'>'.$this->name.'</span> attacked <span style=\'color:blue;\'>'.$enemy->getName();
		$message .= '</span> with <span style=\'color:#bf62b1;\'>'.$attack;

		// if pokemon type = attack type
		if($this->type == $this->attacks[$attack]['type']){
			// multiply damage
			$damage = $this->attacks[$attack]['damage'] * 1.2;
		}
		else {
			// default damage
			$damage = $this->attacks[$attack]['damage'];
		}

		// Check for weakness or resistance
		if($enemy->getWeakness() == $this->attacks[$attack]['type']){
			// Set damage and effectiveness
			$damage = $damage * 1.3;
			$effective .= '[!!] it was super effective <br />';
		}
		elseif($enemy->getResistance() == $this->attacks[$attack]['type']){
			// Set damage and effectiveness
			$damage = $damage * 0.7;
			$effective .= '[!!] it was not effective <br />';
		}

		// remove decimals
		$damage = round($damage);

		// attack log, damage
		$message .= '</span> for <span style=\'color:red;\'>'.$damage.'</span> damage.<br />';

		// calculate new enemy health
		$enemy->setHealth($damage);

		// attack log, new health
		$message .= $effective.'<span style=\'color:blue;\'>'.$enemy->getName().'</span> new health: ';

		// attack log, new health
		$message .= '<span style=\'color:#17bd54;\'>'.$enemy->getHealth().'</span><br />';

		// display attack log
		return $message;
	}
// End methodes

}






 ?>