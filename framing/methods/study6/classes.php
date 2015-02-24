<?php

	 session_start();
	
	//increments trial number
	if (isset($_GET['trialnum'])) {
		$_SESSION['trialnum'] = $_GET['trialnum'];
		if ($_SESSION['trialnum'] > 0) {
			$_SESSION['pause']=true;
			$temp = $_GET['prevtrial']; 
			
			$_SESSION['score']+=$_SESSION['trialscore'];
			echo "<script type=\"text/javascript\">
				window.parent.showScore(".$_SESSION['score'].");
				
			</script>";
			if (isset($_GET['endpractice'])){$_SESSION['endpractice']=true;} else {$_SESSION['endpractice']=false;}
			if (isset($_GET['endphase'])){$_SESSION['endphase']=true;} else {$_SESSION['endphase']=false;}
			if (isset($_GET['endgame'])) {$_SESSION['endgame']=1;} 
			if (isset($_GET['timeborrowed'])) { $timeborrow = $_GET['timeborrowed']; if ($timeborrow>0){$_SESSION['roundsborrowed']++;} } else { $timeborrow = 0; }
			if (isset($_GET['timeused']) && isset($_GET['timegiven'])){ if ($_GET['timegiven']>$_GET['timeused']){ $_SESSION['earlyexit']++;}}
			$_SESSION['data'] = $_SESSION['data'] . $_SESSION['subj'] . "#" . $_SESSION['cond'] . "#" .$_SESSION['practice']. "#$temp#" .$_SESSION['trials'][$temp]->question ."#". $_GET['timegiven'] . "#" . $timeborrow . "#" . $_SESSION['trialscore'] . "#".$_SESSION['guesses']."#".$_GET['timeused']."#".$_SESSION['sched']. "\n";
			
			$_SESSION['sched']="";
			$_SESSION['guesses']=0;
		}
	}

		
	if ($_SESSION['pause'] && $_SESSION['trialnum']>0){
	 	echo "<meta http-equiv=\"Refresh\" content=\"3;url=classes.php\">";
	 	?>
	 	<script type="text/javascript">
				window.parent.setPause(true);
				
		</script>
	
	 	<?php
	 	
	}
	
	
?>

<html>
	<head>
	<title>Survey</title>
	<STYLE TYPE="text/css">
		table.tbl1 {vertical-align: top; border-width: 1px; border-style: solid; border-collapse: collapse; border-color: #eeeeee; font-family: Verdana,sans-serif; font-size: 10pt;}
		td.tbl2 {border-width: 1px;
			padding: 3px;
			border-style: solid;
			border-color: #eeeeee;
			vertical-align: top;}
		table.sub1 {border-width: 0px;}
		td.sub2 {border-width:0px;}
		body { font-family: Verdana, sans-serif; border: 1px;}
table.tblborder {border-spacing: 0px; vertical-align: middle; text-align: center; border-width: 2px; border-style: solid; border-collapse: collapse; border-color: #dddddd; font-family: Verdana,sans-serif; font-size: 10pt;}
td.tdnobord{padding: 5px; vertical-align: top; border-style: solid; border-width: 0px;}

		#board td {
			text-align: center;
			height: 35px;
			width: 400px;
			border: 1px solid black;
			background-color: #ffff99;
		}
		
		</STYLE>
	
	<script type="text/javascript">
		window.onload = function() {
			<?php
				
				if ($_SESSION['trialnum'] == 0 && $_SESSION['practice']==1) {
					$_SESSION['data'] = "";
					$_SESSION['score']=0;
					$_SESSION['sched']="";
					$_SESSION['guesses']=0;
					$_SESSION['finished']=false;
					$_SESSION['endgame']=0;
					$_SESSION['roundsborrowed']=0;
					$_SESSION['earlyexit']=0;
					$_SESSION['introhost']=false;
					echo "window.parent.setCond(" . $_SESSION['cond'] . ");
					window.parent.showScore(".$_SESSION['score'].");";
				}
				
			?>
			
		}
	</script>
	
	</head>
     <body bgcolor = "#ffffff">
 <?php
	
class Feuds{
     	   public $answers = "";
           public $tags="";
     	   public $question="";
           public $correct;
           
           public function Feuds($q, $ans, $tgs){
        		$this->answers=$ans;
        		$this->tags=$tgs;
        		$this->question=$q;
			$this->correct=array();;
           }
           
           
		   //takes user input and checks to see if they guessed an answer correctly.
		   public function check($str){
           
		   	if ($str!="")
		   		$_SESSION['guesses']++;
           		$found=false;
           		$entered=strtoupper($str);
           		$count=0;
           		$count2=0;
           		$temp=explode(",",$this->tags);
	           	
           		for ($i=0;$i<sizeof($temp);$i++)
	           		
           			
           		while ($found==false && $count<5){
	           		$count2=0;
           			$temp2=explode("*",$temp[$count]);
           			while ($count2<sizeof($temp2) && $found==false){
	           			
           				if (strstr($entered,strtoupper($temp2[$count2]))!==false)
	           				$found=true;
           				$count2++;
           			}
           			$count++;
           		
	           	}
           	
    	       	if ($found){
           			$count--;
           			return $count;
           		}
           		else
	           		return false;
           	
           		}
           		
		   
           
}
     

$qs[1]="Name something that you associate with Egypt...";	
$qs[2]="Name a kind of food that gets stuck between your teeth";
$qs[3]="Name an occupation whose people have big egos...";
$qs[4]="Name a place in front of which people double park for a minute...";
$qs[5]="Name something you don't do as much of in cold weather...";
$qs[6]="Name a food you wouldn't eat with your fingers...";
$qs[7]="Name something you see in every deli...";
$qs[8]="Past or present, name a famous artist...";
$qs[9]="Name something you might forget in a restaurant...";
$qs[10]="Name something in the house that is very difficult to move...";

$ans[1]="Pyramids,Sphinx,Camels,Nile River,Desert";
$ans[2]="Corn,Meat,Spinach,Caramel,Nuts";
$ans[3]="Actor,Attorney,Physician,Politician,Pro Athlete";
$ans[4]="Post Office,Store,Bank,Hospital,Dry Cleaners";
$ans[5]="Garden,Swim,Walk/Run,Cookout,Sunbathe";
$ans[6]="Spaghetti,Soup,Mashed Potatoes,Ice Cream,Pudding";
$ans[7]="Meat,Pickles,Cheese,Bread,Potato Salad";
$ans[8]="Pablo Picasso,Vincent van Gogh,Leonardo da Vinci,Michelangelo,Rembrandt van Rijn";
$ans[9]="Purse/Wallet,Coat,To Leave A Tip,Hat,Umbrella";
$ans[10]="Refrigerator,Piano,Couch,Bed,Dresser";

$tgs[1]="Pyramid,Sphinx*Sphynx,Camel,Nile*River,Desert*Dessert*Sand";
$tgs[2]="Corn,Meat*Turkey*Beef*Pork*Chicken*Lamb,Spinach*Spinich,Caramel*Carimel*Caramal,Nut*Peanut*Cashew*Almond*Walnut*Chestnut";
$tgs[3]="Actor*Actress*Hollywood*Movie,Attorney*Lawyer*Prosecutor*Prosecuter,Physician*Doc*Surgeon*Medic,Politic*Diplomat,Athlete*Baseball*Basketball*Football*Hockey*Player";
$tgs[4]="Post*Mail,Store,Bank,Hospital,Cleaner";
$tgs[5]="Garden,Swim*Pool,Walk*Stroll*Hike*Run,Cookout*Grill*Barbecue*BBQ,Tan*Sunbathe";
$tgs[6]="Spaghetti*Noodle*Spagetti*Spahgetti*Spagheti*Spageti,Soup,Mashed,Ice Cream*IceCream,Pudding";
$tgs[7]="Meat*Turkey*Ham*Beef*Chicken*Pork*Lamb,Pickle,Cheese,Bread,Potato";
$tgs[8]="Picasso*Picaso*Piccaso*Piccasso,Vangogh*Vangoh*Van gogh*Van goh,Leonardo*Vinci*Vinchi,Michelangelo*Michaelangelo,Rembrandt*Rembrant";
$tgs[9]="Purse*Wallet*Walett,Coat*Jacket,Tip,Hat,Umbrella";
$tgs[10]="Refrig*Fridge,Piano,Couch*Sofa*Armchair,Bed*Mattress*Matress*Mattres,Dresser*Armoir*Cadenza"; 

$qs[11]="Name a big animal with a short tail...";
$qs[12]="Name something you'd take with you for an afternoon in the park...";
$qs[13]="Name something measured by the spoonful...";
$qs[14]="Name an occasion after which people suffer a little let down...";
$qs[15]="Name a crunchy food...";
$qs[16]="Name something that has a long life...";
$qs[17]="Name a sound that frightens people...";
$qs[18]="Name something to which people's skin might be overly sensitive...";
$qs[19]="Name a sport in which good eyesight is important...";
$qs[20]="Name something that melts easily...";

$ans[11]="Elephant,Bear,Giraffe,Pig,Rhino";
$ans[12]="Picnic,Blanket,Book,Radio/Music,Frisbee";
$ans[13]="Sugar,Medicine,Salt,Coffee,Baking Soda";
$ans[14]="Wedding,Christmas,Birthday,Birth of Baby,Graduation";
$ans[15]="Chips,Celery,Carrots,Cereal,Popcorn";
$ans[16]="Turtle,Tree,Elephant,Battery,People";
$ans[17]="Thunder,Siren,Gunshot,Scream,Howl";
$ans[18]="Sun,Soap,Makeup,Perfume,Wool";
$ans[19]="Baseball,Tennis,Archery,Golf,Hunting";
$ans[20]="Butter,Ice Cream,Snow,Cheese,Chocolate";

$tgs[11]="Elephant,Bear,Giraffe*Girrafe,Pig,Rhino";
$tgs[12]="Picnic*Pic-nic*Pic nic,Blanket,Book*Magazine*Read*Newspaper,Radio*Music*MP3*Ipod*CD*Stereo,Frisbee*Disc*Friz";
$tgs[13]="Sugar,Medic,Salt,Coffee*Cofee,Baking Soda";
$tgs[14]="Wedding*Marriage*Marry,Christmas,Birthday*Birth Day,Childbirth*Baby,Graduat*Commencement";
$tgs[15]="Chip*Crisp,Celery,Carrot,Cereal,Popcorn";
$tgs[16]="Turtle*Tortoise,Tree,Elephant,Battery,Person*People*Human";
$tgs[17]="Thunder*Lightning,Siren*Police,Gun,Scream*Yell,Howl*Wolf";
$tgs[18]="Sun,Soap*Shampoo,Makeup*Cosmetic*Make-up*Make up,Perfume*Cologn,Wool";
$tgs[19]="Baseball,Tennis,Archer*Arrow,Golf,Hunt*Shoot";
$tgs[20]="Butter,IceCream*Ice Cream*Ice-Cream,Snow,Cheese,Choco";


$qs[21]="Name something you keep in your car in case of emergency on the road...";
$qs[22]="Name an activity or occupation in which you would use a whistle...";
$qs[23]="Name a food you pack for the beach...";
$qs[24]="Name a reason why you pull over to the side of the highway...";
$qs[25]="Name an activity from which people come home with sore feet...";
$qs[26]="Name something from home that people take with them on long trips...";
$qs[27]="Name a formerly serious ailment that is easily cured or prevented now...";
$qs[28]="Name a place where people \"Check In\"...";
$qs[29]="Name a fictional character with enormous strength...";
$qs[30]="Name something used only in winter...";

$ans[21]="Flashlight,Flares,Spare,Jack,First Aid Kit";
$ans[22]="Referee,Police,Coach,Gym Teacher,Lifeguard";
$ans[23]="Sandwiches,Chips,Chicken,Hot Dogs,Fruit";
$ans[24]="Flat Tire,Siren,Breakdown,Read Map,Feel Tired";
$ans[25]="Shopping,Running,Dancing,Hiking,Sightseeing";
$ans[26]="Pillow,Clothing,Luggage,Camera,Pet";
$ans[27]="Polio,Pneumonia,Tuberculosis,Flu,Measles";
$ans[28]="Hotel,Hospital,Airport,Doctor's Office,Work";
$ans[29]="Hercules,Samson,Atlas,Superman,Incredible Hulk";
$ans[30]="Snow Shovel,Sled,Coat,Gloves,Snowmobile";

$tgs[21]="Flash light*Flash-light*Flashlight,Flare*Torch,Spare*Tire,Jack,First Aid*First-Aid*FirstAid";
$tgs[22]="Ref*Ump,Police*Cop,Coach,Gym,Lifeguard*Life guard*Life-guard";
$tgs[23]="Sandwich*Sand-wich*Sandwitch,Chip,Chick,Hot Dog*HotDog*Hot-Dog,Fruit";
$tgs[24]="Flat,Siren*Police*Cop*Ambulance*Fire,Break*Broke,Map*Lost*Directions,Tired*Sleepy*Fatigue";
$tgs[25]="Shop,Run,Danc,Hik,Sightsee*Tour";
$tgs[26]="Pillow*Cushion,Cloth,Luggage*Bag*Suitcase,Camera,Pet*Dog*Cat*Hamster";
$tgs[27]="Polio,Pneumonia*Neumonia*Nimonia*Nemonia*Namonia*Pnimonia*Pnamonia,Tuber*TB,Flu,Measle*Meesle";
$tgs[28]="Hotel*Motel*Lodge,Hospital*ER,Airport,Doc,Work*Office";
$tgs[29]="Herc,Samson,Atlas,Superman*Super-man*Super man,Hulk";
$tgs[30]="Shovel,Sled,Coat*Jacket,Glove,Snowmobil*Snow-mobil*Snow mobil";

$qs[31]="Name something your body needs...";
$qs[32]="Name something you see in front of schools...";
$qs[33]="Name an animal that might weigh more than 1,000 pounds...";
$qs[34]="Name something you eat that makes you thirsty";
$qs[35]="Name a mountain chain...";
$qs[36]="Name a state that was part of the confederacy during the U.S. Civil War...";
$qs[37]="Name a food recognizable by its odor...";
$qs[38]="Name the musical instrument which sounds worst, played by a beginner...";
$qs[39]="Name a kind of person you never questioned when you were a child...";
$qs[40]="Name the first sign that you're getting a cold...";

$ans[31]="Water,Food,Oxygen,Exercise,Calcium";
$ans[32]="Flag,Children,Buses,Crossing Guard,School Name";
$ans[33]="Elephant,Rhino,Whale,Hippo,Bear";
$ans[34]="Popcorn,Potato Chips,Ham,Peanuts,Pizza";
$ans[35]="Rockies,Alps,Appalachians,Smokies,Andes";
$ans[36]="Georgia,Virginia,Mississippi,Alabama,South Carolina";
$ans[37]="Onions,Fish,Garlic,Pizza,Cabbage";
$ans[38]="Violin,Trumpet,Clarinet,Tuba,Piano";
$ans[39]="Teacher,Parent,Religious Authority,Police,Principal";
$ans[40]="Runny Nose,Sneezing,Sore Throat,Headache,Stuffed Up";

$tgs[31]="Water,Food,Oxygen*Air,Activity*Exercis*Aerob,Calcium";
$tgs[32]="Flag,Child*Kid*Student,Bus,Crossing*Guard*Patrol,Name*Sign";
$tgs[33]="Elephant,Rhino*Rino,Whale*Wale,Hippo,Bear";
$tgs[34]="Popcorn*Pop-corn*Pop corn,Chip,Ham,Peanut,Pizza";
$tgs[35]="Rock,Alp,Appalachian*Appilachian*Apalachian*Appleachian,Smok,Ande";
$tgs[36]="Georgia,Virginia,Mississippi*Misisipi*Missisippi*Misissippi*Mississipi,Alabama,South Carolina";
$tgs[37]="Onion,Fish*Tuna,Garlic,Pizza,Cabbage";
$tgs[38]="Violin,Trump,Clarinet,Tuba,Piano";
$tgs[39]="Teach,Parent*Mom*Dad*Mother*Father,Priest*Rabbi*Pastor*Reverend*Monk,Police*Cop,Principal";
$tgs[40]="Runny*Sniff*Drip,Sneez,Throat,Headache*Head-ache*Head ache,Congest*Stuff";

$qs[41]="Name a place where you would see lots of flowers...";
$qs[42]="Name a bird...";
$qs[43]="Name a place where people daydream...";
$qs[44]="Name a place that sometimes doesn't allow dogs...";

$qs[45]="Name something you eat by the slice...";
$qs[46]="Name something that kids do when they skip school...";
$qs[47]="Name something you ask a waiter/waitress for...";
$qs[48]="Name an occasion when a teenager wears his or her best clothes...";
$qs[49]="Name something you associate with Hawaii...";
$qs[50]="Name a food you buy more than one of at a time...";

$ans[41]="Florist,Funeral,Garden,Wedding,Park";
$ans[42]="Robin,Eagle,Parrot,Cardinal,Bluebird";
$ans[43]="Work,School,Park,Bathroom,Church";
$ans[44]="Restaurant,Apartment Building,Hotel,Park,Store";
$ans[45]="Bread,Pizza,Cake,Pie,Cheese";
$ans[46]="Go To Movies,Go To Mall,Watch TV,Go To Beach,Play Video Games";
$ans[47]="Water,Coffee,Ketchup,Check,Menu";
$ans[48]="Prom,Date,Graduation,Church,Wedding";
$ans[49]="Lei,Pineapple,Hula Dancers,Beach,Luau";
$ans[50]="Potatoes,Eggs,Apples,Bananas,Grapes";

$tgs[41]="Florist*Flowershop*Flower Shop,Funeral*Wake,Garden,Wedding*Marr,Park";
$tgs[42]="Robin,Eagle,Parrot*Parrott*Parott*Parot,Card,Blue";
$tgs[43]="Work*Office,School*Class,Park,Bath*Restroom*Toilet*Shower,Church*Synagogue*Temple*Sermon";
$tgs[44]="Restaurant*Diner,Apartment*Condo,Hotel*Motel*Lodge,Park,Store*Grocery*Mall";
$tgs[45]="Bread,Pizza,Cake,Pie,Cheese";
$tgs[46]="Movie*Cinema*Theater*Theatre,Mall,TV*Television*Teevee*T.V,Beach,Video Games*Xbox*Wii*Playstation*Video-games";
$tgs[47]="Water,Coffee,Ketchup*Catsup,Check*Bill*Tab,Menu";
$tgs[48]="Prom,Date,Graduat,Church*Temple,Wedding*Marr";
$tgs[49]="Lei*Lay*Lie*Lae*Lea,Pineapple*Pine-apple*Pine apple,Hula,Beach*Sand*Ocean,Lua*Lau*Loo";
$tgs[50]="Potat,Egg,Apple,Banana*Bannana*Bananna,Grape";

$qs[51]="Name something that's hardest to do the first time you try it...";
$qs[52]="Name a food people eat and then regret later...";
$qs[53]="Name something that goes \"Boom!\"...";
$qs[54]="Name an animal that likes to poke around in your garbage late at night...";
$qs[55]="Name something that puts people to sleep...";
$qs[56]="Name something you buy frozen...";
$qs[57]="Besides \"King\" & \"Queen,\" name a title some people have in England...";
$qs[58]="Name an ingredient in meat loaf, besides meat...";
$qs[59]="Name something that is easy to do forwards, but hard backwards...";
$qs[60]="Besides clothing, name something you wash by hand...";

$ans[51]="Ride a Bicycle,Ski,Drive,Skate,Swim";
$ans[52]="Onions,Chili,Beans,Ice Cream,Peppers";
$ans[53]="Cannon,Fireworks,Thunder,Bomb,Sonic Boom";
$ans[54]="Raccoon,Dog,Cat,Possum,Skunk";
$ans[55]="Medication,Reading,Music,TV,Milk";
$ans[56]="Ice Cream,Vegetables,TV Dinner,Pizza,Fish";
$ans[57]="Prince,Duke,Sir,Lord,Duchess";
$ans[58]="Eggs,Bread Crumbs,Onion,Tomato,Ketchup";
$ans[59]="Walk,Run,Drive,Write,Skate";
$ans[60]="Dishes,Car,Crystal,Body,Pets";

$tgs[51]="Bike*Bic,Ski,Drive*Car,Skate,Swim";
$tgs[52]="Onion,Chile*Chili*Chilli*Chilly,Bean,IceCream*Ice Cream*Ice-Cream,Pepp";
$tgs[53]="Canon*Cannon*Canonn*Cannonn,Firework*Firecra,Thunder*Lightning,Bomb,Sonic";
$tgs[54]="Rac,Dog,Cat,Poss*Oposs,Skunk";
$tgs[55]="Medic,Read*Book*Magaz,Music*Tunes,TV*Television*Teevee*T.V,Milk";
$tgs[56]="IceCream*Ice Cream*Ice-Cream,Veg,TV Din*T.V. Din,Pizza,Fish";
$tgs[57]="Prince,Duke,Sir*Knight,Lord,Duches";
$tgs[58]="Egg,Bread*Crum,Onion,Tomato,Ketchup*Catsup";
$tgs[59]="Walk,Run,Drive*Car,Write,Skate";
$tgs[60]="Dish,Car*Truck,Crystal,Body,Pet*Dog*Cat";


$qs[61]="Name something you'd wear even if it has a hole in it...";
$qs[62]="Name something that happens at every child's birthday party...";
$qs[63]="Name a food that you boil in a big pot...";
$qs[64]="Name something made for the mouth...";
$qs[65]="Name an occupation whose workers should know CPR...";
$qs[66]="Give me another word for \"Meathead\"...";
$qs[67]="Besides candy name something that might have a chocolate covering...";
$qs[68]="Name the college selected by the brightest students...";
$qs[69]="Name something people carry in their hands as they board airplanes...";
$qs[70]="Name something specific which people clean for a living...";

$ans[61]="Sock,Jeans,Underwear,Shoe,Sweater";
$ans[62]="Blow Out Candles,Eat Cake,Sing Happy Birthday,Spill Things,Play Games";
$ans[63]="Pasta,Soup,Potatoes,Chicken,Corn";
$ans[64]="Braces,Toothbrush,Dentures,Lipstick,Toothpaste";
$ans[65]="Paramedic,Nurse,Firefighter,Ambulance Driver,Lifeguard";
$ans[66]="Dummy,Stupid,Idiot,Dumbbell,Jerk";
$ans[67]="Cake,Ice Cream,Cookies,Nuts,Raisins";
$ans[68]="Harvard,Yale,MIT,Stanford,UCLA";
$ans[69]="Ticket,Carry On,Book,Camera,Purse";
$ans[70]="Carpets,Houses,Cars,Windows,Clothes";

$tgs[61]="Sock*Sox,Jean*Denim,Boxers*Briefs*Panties*Under,Shoe*Boot,Sweater";
$tgs[62]="Candle,Cake,Sing,Spill*Mess*Dirt,Game*Play";
$tgs[63]="Pasta*Spag*Macar,Soup,Potato,Chick*Chik,Corn";
$tgs[64]="Brace,Toothbrush*Tooth-brush,Denture*Fake,Lipstick*Lipbalm*Lipgloss,Paste";
$tgs[65]="Paramed*EMT,Nurse,Fire,Ambulance,Lifeguard*Life-guard*Life guard";
$tgs[66]="Dumm,Stup,Idiot,Bell,Jerk";
$tgs[67]="Cake,IceCream*Ice Cream*Ice-Cream,Cookie,Nut,Rais";
$tgs[68]="Harvard,Yale,MIT*M.I.T,Stanf,UCLA*U.C.L.A";
$tgs[69]="Tick*Tix*Pass,Bag*Backpack*Carry on*Carry-on,Book*Magaz,Camera,Purse";
$tgs[70]="Carpet*Rug,House*Home,Car,Window,Cloth";


$qs[71]="Name something you use often, that's always breaking down...";
$qs[72]="Name something about commercial air travel worse now than 10 years ago...";
$qs[73]="Name something people give to celebrities to autograph...";
$qs[74]="Name something you wish you could do faster...";
$qs[75]="Name something that can give you blisters...";
$qs[76]="Name something people cut...";
$qs[77]="Name the filling you hope for when you bite into a chocolate...";
$qs[78]="Name the most indispensable electric kitchen appliance...";
$qs[79]="Name a kind of place that can be very romantic...";
$qs[80]="Name something that lets off steam...";

$ans[71]="Car,Lawn Mower,Vacuum Cleaner,Copier,Dishwasher";
$ans[72]="Price,Delay,Food,Terrorism,Crowds";
$ans[73]="Napkin,Photo,Program,Blank Paper,Book";
$ans[74]="Type,Work,Read,Run,Lose Weight";
$ans[75]="Shoes,Gardening,Shoveling,Fire,Sweeping";
$ans[76]="Hair,Meat,Paper,Wood,Grass";
$ans[77]="Caramel,Nuts,Chocolate,Liquid Cherry,Nougat";
$ans[78]="Can Opener,Coffee Maker,Toaster,Microwave,Refrigerator";
$ans[79]="Beach,Restaurant,Tropical Island,Cruise,Park";
$ans[80]="Teakettle,Clothes Iron,Train,Pressure Cooker,Steam Engine";

$tgs[71]="Car*Truck,Mower,Vac,Copy*Copier*Xerox*Zerox,Dish";
$tgs[72]="Price*Cost,Delay*Wait,Food,Terror,Crowd";
$tgs[73]="Napk*Tissue,Photo*Pic,Program,Paper,Book";
$tgs[74]="Type,Work,Read,Run,Fit*Exercise*Weight";
$tgs[75]="Shoe*Boot,Garden,Shovel,Fire*Heat*Burn,Sweep*Broom";
$tgs[76]="Hair,Meat*Beef*Chick*Turk*Pork,Paper,Wood*Lumber*Tree,Grass*Lawn*Yard";
$tgs[77]="Caramel*Carmel*Carimel*Caramal,Nut,Choc,Cherry,Noug*Nug*Noog";
$tgs[78]="Can Open*Can-Open,Coffee,Toast,Micro,Refrig*Fridge";
$tgs[79]="Beach*Shore*Ocean,Restaurant,Tropic*Isl,Cruise*Ship*Boat,Park";
$tgs[80]="Tea*Kettle,Iron,Train,Pressure Cooker*Pressure-Cooker,Engine";

$qs[81]="Name something people can inherit genetically from their parents...";
$qs[82]="Name an occupation in which you think there's a large divorce rate...";
$qs[83]="Name something kids imitate the sound of...";
$qs[84]="Name a kind of candy that comes in different colors...";
$qs[85]="Name a family dinner you'd never serve to company...";
$qs[86]="Name something Switzerland is famous for...";
$qs[87]="Name a physical characteristic of a comic book or TV Martian...";
$qs[88]="Name an occupation that begins with the letter \"B\"...";
$qs[89]="Name something that gets in your eyes and stings them...";
$qs[90]="Name a vehicle you can recognize by the sound it makes...";

$ans[81]="Eye Color,Hair Color,Height,Nose,Heart Problems";
$ans[82]="Police,Show Business,Physician,Truck Driver,Sales";
$ans[83]="Dog,Car,Train,Siren,Cow";
$ans[84]="Lifesavers,M & M,Taffy,Jellybeans,Lollipops";
$ans[85]="Hot Dogs,Meat Loaf,Casserole,Macaroni,Hamburger";
$ans[86]="Alps,Chocolate,Clocks,Cheese,Skiing";
$ans[87]="Green Body,Antenna,Big Eyes,Pointy Ears,Big Head";
$ans[88]="Baker,Barber,Bartender,Banker,Butcher";
$ans[89]="Soap,Smoke,Onion Fumes,Dust,Chlorine";
$ans[90]="Motorcycle,Car,Train,Airplane,Boat";

$tgs[81]="Eye,Hair,Height*Tall,Nose,Heart";
$tgs[82]="Police*Cop,Hollywood*Show Biz*Act*Celeb,Physician*Doc*Surgeon*Medic,Truck*Driver,Sales";
$tgs[83]="Dog*Woof,Car*Vroom,Train*Chug*Choo,Siren*Cop*Police*Fire*Ambul,Cow*Moo";
$tgs[84]="Savers,M&M*M & M*M and M*M-and-M*M-&-M,Taffy,Jelly*Bean,Loll*Sucker";
$tgs[85]="Wiener*Weener*Dog,Loaf,Casser*Caser,Mac,Burger";
$tgs[86]="Alp,Choc,Clock*Watch,Cheese,Ski";
$tgs[87]="Green,Ante,Big Eyes*Large Eyes*Bug Eyes,Pointy,Big Head*Large Head";
$tgs[88]="Bake,Barber,Bartend*Bar-tend*Bar tend,Bank,Butch";
$tgs[89]="Soap*Sud,Smoke*Fire,Onion,Dust,Chlor*Clor";
$tgs[90]="Motorcycle*Motorbike,Car,Train,Plane,Boat*Ship";

$qs[91]="Name a place where you see more kids than adults...";
$qs[92]="Name something that people use to pick a lock...";
$qs[93]="Name something that Texas is famous for...";
$qs[94]="Name a famous street anywhere in the world...";
$qs[95]="Besides a bathing suit, name something people wear in the water...";
$qs[96]="Name something that sound sleepers often sleep through...";
$qs[97]="Name something that rises, besides the sun and the moon...";
$qs[98]="Name a fruit you eat with a spoon...";
$qs[99]="Name something that people spread...";
$qs[100]="Give me a word or phrase you might hear in a courtroom during a trial...";

$ans[91]="School,Park,Video Arcade,Amusement Park,Concerts";
$ans[92]="Hairpin,Credit Card,File,Knife,Screwdriver";
$ans[93]="Oil,The Alamo,Cattle,Cowboys,Football";
$ans[94]="Broadway,Fifth Ave,Bourbon Street,Wall Street,Hollywood Blvd";
$ans[95]="Goggles,Bathing Cap,Shorts,Wet Suit,Ear Plugs";
$ans[96]="Storms,Alarm Clock,Phone Ringing,Siren,Earthquake";
$ans[97]="Bread,Tide,Temperature,Balloon,Hot Air";
$ans[98]="Grapefruit,Cantaloupe,Strawberries,Peaches,Blueberries";
$ans[99]="Butter,Rumors,Germs,Peanut Butter,Jam";
$ans[100]="Order,Objection,Guilty,Your Honor,Overruled";

$tgs[91]="School,Park,Arcade,Amusement*Six Flags*Disney,Concert*Music";
$tgs[92]="Hairpin*Hair pin*Hair-pin,Card,File,Knife,Screwdriver*Screw-driver*Screw driver";
$tgs[93]="Oil,Alamo,Cattle*Cows*Ranch,Cowboy,Footbal";
$tgs[94]="Broadway,Fifth*5th,Bourbon,Wall,Hollywood";
$tgs[95]="Goggle,Cap,Short,Wet suit*Wetsuit*Wet-suit,Plug";
$tgs[96]="Storm*Thunder*Lightning,Alarm,Phone,Siren*Police*Cop*Fire*Ambul,Quake";
$tgs[97]="Bread*Dough,Tide*Ocean*Wave,Temp*Degree,Balloon,Hot air*Hotair*Hot-air";
$tgs[98]="Grapefruit*Grape-fruit*Grape fruit,Canta*Melon*Mellon,Strawb,Peach,Blueb";
$tgs[99]="Butter,Rumor*Gossip,Germ,Peanut*PB*P.B,Jam*Jelly";
$tgs[100]="Order,Object,Guilt,Honor,Over ruled*Over-ruled*Overr";

//practice:
$pqs[1]="Name something fathers buy for their kids but play with themselves...";
$pqs[2]="Name something that usually breaks when you drop it...";
$pqs[3]="Name something at a house that uses a lot of water...";
$pqs[4]="Name something people buy with the future in mind...";
$pqs[5]="Name a breed of dog that you would describe as annoying...";
$pqs[6]="Name a specific item that you have on the patio...";
$pqs[7]="Name an expensive fabric...";
$pqs[8]="Name something that people fight about with their next door neighbors...";
$pqs[9]="Name a sport that is not regulated by a clock...";
$pqs[10]="Name a kind of place that might have an information booth...";
$pqs[11]="Name something you replace in your bathroom on a regular basis...";
$pqs[12]="Name a place where you sit in an adjustable seat...";
$pqs[13]="Name a reason for an office party...";
$pqs[14]="Name a bird with legs that look long...";
$pqs[15]="Name something you should take along with you on a fishing trip...";
$pqs[16]="Besides pills, name a cure for headaches...";


$pans[1]="Train Set,Video Games,Model Car,Kite,Computer";
$pans[2]="Glass,China,Egg,Light Bulb,Mirror";
$pans[3]="Washing Machine,Shower,Lawn,Dishwasher,Toilet";
$pans[4]="House,Stocks,Insurance,Furniture,Car";
$pans[5]="Chihuahua,Poodle,Pit Bull,Doberman Pinscher,Pekingese";
$pans[6]="Barbecue,Chair,Table,Plant,Swing";
$pans[7]="Silk,Velvet,Cashmere,Satin,Suede";
$pans[8]="Pets,Noise,Property Line,Kids,Yard";
$pans[9]="Baseball,Tennis,Golf,Bowling,Gymnastics";
$pans[10]="Mall,Airport,Amusement Park,Hospital,Museum";
$pans[11]="Toilet Paper,Towels,Soap,Tissues,Toothpaste";
$pans[12]="Car,Airplane,Dentist's Office,Barber,Movie";
$pans[13]="Christmas,Retirement,Birthday,Promotion,Going Away";
$pans[14]="Ostrich,Flamingo,Stork,Crane,Heron";
$pans[15]="Fishing Pole,Bait,Bug Spray,Food,Boots";
$pans[16]="Sleep,Rest,Cold Compress,Massage,Hot Shower";

$ptgs[1]="Train*Choo,Video*Arcade,Model*Car,Kite,Comp*PC*CPU";
$ptgs[2]="Glass,China*Porc*Ceram,Egg,Light*Bulb,Mirr";
$ptgs[3]="Laundry*Washing,Shower*Bath*Tub,Lawn*Yard*Grass,Dish,Toilet*Potty*John";
$ptgs[4]="House*Home,Stock,Insur,Furniture*Sofa*Table*Chair*Couch,Car*Auto*Truck*Van";
$ptgs[5]="Chi,Poodle,Bull,Dober*Pinscher*Pincher,Pek";
$ptgs[6]="BBQ*Barb*Grill,Chair,Table,Plant,Swing";
$ptgs[7]="Silk,Velvet,Cashm*Caz,Satin*Sateen,Suede*Seude*Leather";
$ptgs[8]="Pet*Dog*Cat,Nois*Loud,Property*Fence*Border*Line,Kid*Child,Yard*Grass*Lawn";
$ptgs[9]="Base,Tenn,Golf,Bowl,Gymn";
$ptgs[10]="Mall,Airp,Amusement,Hosp*Doc,Museum*Musuem";
$ptgs[11]="TP*Paper,Towel,Soap,Tissue,Toothpast";
$ptgs[12]="Car,Plane,Dentist,Barb*Hair*Salon,Movie*Cin*Theat";
$ptgs[13]="Christ*Xmas,Retire*Quit*Leav,Birth*Bday,Promot*Raise,Voyage*Away";
$ptgs[14]="Ostr,Flamin,Stork,Crane*Crain,Heron*Herin*Herron";
$ptgs[15]="Pole,Bait*Bate*Worm,Repel*Bug*Spray,Food*Eat*Snack,Boot*Golash*Galosh*Wade*Shoe";
$ptgs[16]="Sleep*Nap,Rest,Comp*Ice*Cold,Massage*Masage,Shower*Bath*Soak";








//fill initial array and shuffle...
if ($_SESSION['trialnum']==0){
	if ($_SESSION['practice']==1){
		for ($i=1;$i<=16;$i++){
			
			$_SESSION['trials'][$i]=new Feuds($pqs[$i],$pans[$i],$ptgs[$i]);
			
		}
		for ($i=1;$i<=16;$i++){
			$ind=rand(1,16);
			$hold=$_SESSION['trials'][$ind];
			$_SESSION['trials'][$ind]=$_SESSION['trials'][$i];
			$_SESSION['trials'][$i]=$hold;
		}
		
		
	}
	
	else if ($_SESSION['practice']==2){
		//will refresh back into this with trialnum=0 and re-run as usual.
		for ($i=1;$i<=50;$i++){
			$_SESSION['trials'][$i]=new Feuds($qs[$i],$ans[$i],$tgs[$i]);
		}
	

		//DO NOT CHANGE THIS TO "SHUFFLE"--shuffle assumes 0 to 49 index.

		for ($i=1;$i<=50;$i++){
			$ind=rand(1,50);
			$hold=$_SESSION['trials'][$ind];
			$_SESSION['trials'][$ind]=$_SESSION['trials'][$i];
			$_SESSION['trials'][$i]=$hold;
		}
	}
	else{
		for ($i=51;$i<=100;$i++){
			$_SESSION['trials'][$i-50]=new Feuds($qs[$i],$ans[$i],$tgs[$i]);
		}
		for ($i=1;$i<=50;$i++){
			$ind=rand(1,50);
			$hold=$_SESSION['trials'][$ind];
			$_SESSION['trials'][$ind]=$_SESSION['trials'][$i];
			$_SESSION['trials'][$i]=$hold;
		}
	
	}
	
	
	
	
	
	$_SESSION['trialnum']++;
	
	
}
//check to see if they got the question right
else if ($_SESSION['trialnum']<=$_SESSION['NUM'] && !$_SESSION['pause']){
	$total=0;
	$rung=$_SESSION['trials'][$_SESSION['trialnum']]->check($_POST['val']);
	if ($rung!==false){
		$_SESSION['trials'][$_SESSION['trialnum']]->correct[$rung] = 1;
		for ($i=0; $i<5; $i++) { 
			$total = $total + $_SESSION['trials'][$_SESSION['trialnum']]->correct[$i];
		}
		
		$old=$_SESSION['trialscore'];
		$_SESSION['trialscore']=$total;
		
		$moveit="";
		if ($total==5){
			$_SESSION['sched'].=$_POST['timestamp'];
			$moveit="window.parent.newTrial();";
		}
		if ($total<5){

			if ($total==$old)
				faceit(9);
			else{
				faceit($total-1);
				$_SESSION['sched'].=$_POST['timestamp'].",";
			}
		}
		
		echo "<br><br>";
		$total+=$_SESSION['score'];

		echo "<script type=\"text/javascript\">
				window.parent.showScore(".$total.");
				$moveit
		</script>";
	
	}
	else if ($_SESSION['guesses']>0){
		
		faceit(5);
		echo "<br><br>";
	}
}

if ($_SESSION['practice']==1 && $_SESSION['trialnum']==1 && $_SESSION['pause'] && !$_SESSION['introhost']){
	if ($_SESSION['cond']==0 || $_SESSION['cond']==2){
		$totaltime=75;
		$plength="1 minute and 15 seconds";
	}
	else{
		$totaltime=250;
		$plength="4 minutes and 10 seconds";
	}
		
	$_SESSION['NUM']=50;
	$trialtime=$totaltime/5;
	$timetillnext=$trialtime*.4;
	
	$_SESSION['introhost']=true;
	echo "<span style=\"font-size:11pt;\">Thank you for participating.  In what follows, you will play rounds from the game show <i>Family Feud</i>.  In each round, you will guess the
	most popular responses to survey questions (e.g., \"Name things to take on a picnic\").<br><br>
	
	For each correct response, you earn a point.  Each point provides an entry
	into a lottery for a $5 Gift Certificate from Amazon.com.  The more points you earn, the better your chances of winning.<br><br>
	
	On the panel to the right, there will be an indication of the round number you are on and of how
	many points you have earned so far.  You will also see the time remaining for the current round.  (As you can see, this information is already listed for the first round.)  
	
	<br><br>This game will have 5 rounds, for which you will have $totaltime seconds.  The game will end when you finish all 5 rounds or exhaust the total time given, whichever comes first. <br><br>";
	
	echo "The amount of time that each round starts with depends on how much total time you have left.  The total time will be divided evenly among the remaining rounds in the game.  For example, since you currently have $totaltime seconds and 4 rounds to complete, the first round will start with $trialtime seconds.  No round 
	will ever start with more than $trialtime seconds, but rounds can start with less.<br><br>";
	
	if ($_SESSION['cond']<-2)
		echo "  After the initial time for a round elapses, you will automatically be moved to the next round.";
	else
		echo "  After the initial time for a round elapses, you will begin to borrow time from future rounds.  Each second (beyond the initial time given) spent on a round will subtract two seconds from your remaining total time.";
		
	echo "  In the lower right of the panel, you can see a counter of the total time remaining.  <br><br>After the initial $timetillnext seconds of each round, the 'Next Round' button will become active
	and you can click that button to move on whenever you like.  Following each round, you will be shown the answers.  You can take longer or move on to rounds as you see fit, within the constraints mentioned above.
	To begin, please <a href=\"classes.php\">click here</a>.";
	
	
	/*?>
	
	 	<script type="text/javascript">
				window.parent.setPause(true);
				
		</script>
	

	<?php*/
		//$_SESSION['pause']=false;
}


else if ($_SESSION['practice']==2 && $_SESSION['trialnum']==1 && $_SESSION['pause']){
	
	if ($_SESSION['cond']==0 || $_SESSION['cond']==2)
		$totaltime=150;
	else
		$totaltime=500;
		
	$trialtime=$totaltime/10;
	$timetillnext=$trialtime*.4;
		
	echo "In a moment you will begin the first game session where points will earn you actual entries into the lottery for prizes.  For the most part, this game will follow the same rules as in the practice session.<b> Unlike the practice session, the game will consist of 10 rounds.</b>  The game will
	end when you finish all 10 rounds or exhaust the total time given, whichever comes first.
	<br><br>As a reminder: The amount of time that each round starts with depends on how much total time you have left.  The total time will be divided evenly among the remaining rounds in the game.  For example, since you currently have $totaltime seconds and 10 rounds to complete, the first round will start with $trialtime seconds.  No round 
	will ever start with more than $trialtime seconds, but rounds can start with less.<br><br>";
	
	if ($_SESSION['cond']<2)
		echo "  After the initial time for a round elapses, you will automatically be moved to the next round.";
	else
		echo "  After the initial time for a round elapses, you will begin to borrow time from future rounds.  Each second (beyond the initial time given) spent on a round will subtract two seconds from your remaining total time.";
		
	echo "  In the lower right, you can see a counter of the total time remaining.<br><br>After the initial $timetillnext seconds of each round, the 'Next Round' button will become active
	and you can click that button to move on whenever you like.  Following each round, you will be shown the answers.  
	<br><br>Remember, your goal is to earn as many points as you can (which will give you a better chance of winning a prize).  You can take longer or move on to rounds as you see fit, within the constraints mentioned above.
	Good luck!  To begin the game, please <a href=\"classes.php\">click here</a>.";
	
	
	?>
	
	 	<script type="text/javascript">
				window.parent.setPause(true);
				
		</script>
	

	<?php
		$_SESSION['pause']=false;
}
else if ($_SESSION['practice']==3 && $_SESSION['trialnum']==1 && $_SESSION['pause']){
	$prevtotal=$_SESSION['prevtotal'];
		
	echo "When you are ready, you may begin your second game session.  All of the rules are the same as in the first game session.  The points that you earn in this session will be added to your previous total ($prevtotal points), so you should still try to earn as many points as you can to give yourself a better chance of winning a prize.  Good luck!  To begin the game, please <a href=\"classes.php\">click here</a>.";
	
	
	?>
	
	 	<script type="text/javascript">
				window.parent.setPause(true);
				
		</script>
	

	<?php
		$_SESSION['pause']=false;
}
else if ($_SESSION['trialnum']<=($_SESSION['NUM']+1) && $_SESSION['pause']){
	//show answers from previous trial.
	if ($_SESSION['introhost']){
		faceit(8);
		echo "<br><br>";
		$_SESSION['introhost']=false;
		
	}
	else{
	if ($_SESSION['trialscore']==5)
		faceit(4);
	else
		faceit(7);
	echo "<center><br><br>Question: ";
	echo $_SESSION['trials'][$_SESSION['trialnum']-1]->question."<br><br>";
	$_SESSION['trialscore']=0;
	
	
	?>
	
	<center><table id="board">
	<?php
		
		for ($i=0;$i<5;$i++) {
			$tmp=explode(",",$_SESSION['trials'][$_SESSION['trialnum']-1]->answers);
			echo "<tr><td style='background-color: #ffcccc;'>$tmp[$i]</td></tr>";
			
		}
	}
	?>
	</table></center>
	
	<?php
	$_SESSION['pause']=false;
}

else if ($_SESSION['trialnum'] <= $_SESSION['NUM'] && !$_SESSION['pause'] && $_SESSION['endgame']==0 && !$_SESSION['endpractice'] && !$_SESSION['endphase']) {
if ($_SESSION['guesses']==0){
	faceit(6);
	echo "<br><br>";	 		
}
?>

	
	


<center>
<table id="board">
	<?php
		for ($i=0;$i<5;$i++) {
			if ($_SESSION['trials'][$_SESSION['trialnum']]->correct[$i] == 1) {
				$tmp=explode(",",$_SESSION['trials'][$_SESSION['trialnum']]->answers);
				echo "<tr><td style='background-color: #ffcccc;'>$tmp[$i]</td></tr>";
			} else {
				$temp = $i + 1;
				echo "<tr><td>($temp)</td></tr>";
			}
		}
	?>
</table>
</center>

<br /><br />
	<?php
		if ($_SESSION['guesses'] == 0) {
			echo "
				<script type='text/javascript'>
					window.parent.setPause(false);
					
				</script>
			";
		}
		
echo "<center>";
echo $_SESSION['trials'][$_SESSION['trialnum']]->question."<br><br>";
$temp = $_SESSION['trialnum'];
echo "<form name=\"f\" action=\"classes.php?\" method=\"post\"><input type=\"text\" size=\"100\" id=\"val\" name=\"val\" autocomplete=\"off\">";
echo "<input type=\"hidden\" name=\"timestamp\">";
echo "<br><br><input type=\"submit\" value=\"enter guess!\">";
echo "</center></form>

<script type='text/javascript'>
if (val = document.getElementById(\"val\")) { val.focus(); }
</script>";

}
else if ($_SESSION['endpractice']){
	$_SESSION['endpractice']=false;
 	$_SESSION['practice']++;
	
	
 			$outFile = "data/practiceresults.csv";
			$fh = fopen($outFile,'a');
			fwrite($fh, $_SESSION['data']);
			fclose($fh);
			$_SESSION['data']="";
 			$_SESSION['score']=0;
 			$_SESSION['roundsborrowed']=0;
 			$_SESSION['earlyexit']=0;
	 		echo "Great, you've finished the practice session.  The next page will briefly explain a few remaining details about 
			timing in the game.  To read these instructions, please <a href=\"classes.php?trialnum=0\">click here</a>.";
		
		?>
		
	 		<script type="text/javascript">
					
					window.parent.donePractice();
					window.parent.showScore(0);
				
			</script>
	

		<?php
			$_SESSION['pause']=true;
	 
 }
 else if ($_SESSION['endphase']){
	$_SESSION['endphase']=false;
	$_SESSION['practice']++;
			$_SESSION['prevtotal']=$_SESSION['score'];
 			$_SESSION['score']=0;
 			$_SESSION['roundsborrowed']=0;
 			$_SESSION['earlyexit']=0;
	 		echo "You have finished the first game session.  To continue, please <a href=\"classes.php?trialnum=0\">click here</a>.";
		
		?>
		
	 		<script type="text/javascript">
					
					window.parent.donePractice();
					window.parent.showScore(0);
				
			</script>
	

		<?php
			$_SESSION['pause']=true;
	 
 
 
 }

 else if($_SESSION['endgame']==1){
 echo "<b>Thank you, you're nearly done.  We just want to ask you a couple questions to see how you understood the game.</b><br><br><br>";
 echo "<script type=\"text/javascript\" src=\"funcs/formcheck.js\"></script><form name='f' method='post' action=''>";
 if ($_SESSION['cond']<2){
 //ask small
 echo "When you started, how many seconds were you given for just the first round?<br><input type='text' size='5' name='tmest'>seconds<br><br><br><br>";
 }
 else{
	echo "When you started, how many seconds were you given for the entire game (all five rounds)? &nbsp; &nbsp; &nbsp; <input type='text' size='5' name='tmest'>seconds<br><br>";
 }
 echo "
 Imagine that there was a glitch on the first round and that the experiment froze, leading you to lose 10 seconds from the round.  Think about how that would feel.  How expensive or costly would that glitch feel to you?<br><br>
 <table class='tblborder'><tr>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='1'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='2'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='3'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='4'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='5'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='6'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='7'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='8'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='9'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='10'></td>
	<td class='tdnobord' width='75'><input type='radio' name='expense' value='11'></tr><tr>
	<td class='tdnobord' width='75'>1</td>
	<td class='tdnobord' width='75'>2</td>
	<td class='tdnobord' width='75'>3</td>
	<td class='tdnobord' width='75'>4</td>
	<td class='tdnobord' width='75'>5</td>
	<td class='tdnobord' width='75'>6</td>
	<td class='tdnobord' width='75'>7</td>
	<td class='tdnobord' width='75'>8</td>
	<td class='tdnobord' width='75'>9</td>
	<td class='tdnobord' width='75'>10</td>
	<td class='tdnobord' width='75'>11</td></tr>
	<td class='tdnobord' width='75'>Not expensive at all</td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'></td>
	<td class='tdnobord' width='75'>Very Expensive</td></tr><tr>
	</table><br><br>";
 
 echo "<input type='submit' onClick='valform(this.parentNode); return false;' value='Submit' />
 </form>";
 $_SESSION['endgame']++;
 }
 
 else if ($_SESSION['endgame']==2){
 	$_SESSION['tmest']=$_POST['tmest'];
	$_SESSION['expense']=$_POST['expense'];
	//demographics here, also ask email address and store condition with email address
	echo "<script type=\"text/javascript\" src=\"funcs/formcheck.js\"></script><b>Demographics</b><br /><br />";
	echo "<form method='post' action=''>";
	echo "Gender: <input type='radio' name='gender' value='m' />M ";
	echo "<input type='radio' name='gender' value='f' />F";
	echo "<br /><br />Age: <input type='text' size='3' name='age' />";
	echo "<br /><br />Race/Ethnicity: <input type='text' size='20' name='race' />";
	echo "<br /><br />Email address: <input type='text' size='20' name='email' />";
	echo "<br /><br /><input type='submit' onClick='valform(this.parentNode); return false;' value='Submit' />";
	echo "</form>";

	
	$_SESSION['endgame']++;
}
/*
else if ($_SESSION['endgame']==2){
	$outFile = "data/results.csv";
	$fh = fopen($outFile,'a');
	fwrite($fh, $_SESSION['data']);
	fclose($fh);	

	$outFile = "data/demographics.csv";
	$fh = fopen($outFile,'a');
	$stringData = $_SESSION['subj'] . "," . $_SESSION['cond'] . "," . $_POST['age'] . "," . $_POST['gender'] . "," . $_POST['race'] . "," . $_POST['email'] . "\n";
	fwrite($fh, $stringData);
	fclose($fh);
	//test knowledge of their performance;
	echo "<script type=\"text/javascript\" src=\"funcs/formcheck.js\"></script>";
	echo "<script type=\"text/javascript\">window.parent.clearOut();</script>";
	echo "You are almost finished.  In these final questions, you will be asked about your experience in the game.  Use your own personal estimates to answer these questions.  You should answer based only on the rounds from the actual
	game--not based on the practice rounds.<br><br>";
	echo "<form name=\"f\" method=\"post\" action=\"classes.php\">";
	echo "1.)  If there were five possible answers on a round and you got three right, how many lottery entries would you earn?<br>
	<input type=\"text\" size\"5\" name=\"number1\"><br><br>";
	echo "2.)  On each round, how many seconds did you have to wait before the 'next round' button became active?<br>
	<input type=\"text\" size\"5\" name=\"number2\"><br><br>";
	echo "3.)  On how many rounds do you think you clicked the 'next round' button before time expired?<br>
	<input type=\"text\" size\"5\" name=\"number3\"><br><br>";
	echo "4.)  How many rounds do you think you completed?<br>
	<input type=\"text\" size\"5\" name=\"number4\"><br><br>";
	echo "5.)  How many points do you think you earned?<br>
	<input type=\"text\" size\"5\" name=\"number5\"><br><br>
	<input type='submit' onClick='valform(this.parentNode); return false;' value='Submit' />";
	$_SESSION['endgame']++;
	
}*/
else{
	$outFile = "data/results.csv";
	$fh = fopen($outFile,'a');
	fwrite($fh, $_SESSION['data']);
	fclose($fh);	

	$outFile = "data/demographics.csv";
	$fh = fopen($outFile,'a');
	$stringData = $_SESSION['subj'] . "," . $_SESSION['cond'] . "," . $_POST['age'] . "," . $_POST['gender'] . "," . $_POST['race'] . "," . $_POST['email'] . ",".$_SESSION['tmest'].",".$_SESSION['expense']. "\n";
	fwrite($fh, $stringData);
	fclose($fh);
	
	include 'funcs/numbers.php';
	echo "You have completed this study.  Your number is " . $num . ".  Thank you for participating.";
	
}

function faceit($caller){
//caller 0-4: # correct, building excitement.
//5: incorrect
//6: new trial
//7: answers
//8: welcome.

$temp[0]="Yup.,Correct.,Good one.,Good start.,Not bad.";
$temp[1]="Yes.,Nicely done., Terrific.,Now you're getting somewhere.,Moving forward nicely.";
$temp[2]="Impressive!,Wow!,Absolutely amazing!,Hey now! Three right!,You're in the zone!";
$temp[3]="Holy smokes!!,And again! Yes! Yes! Yes!,Would you look at that! Another one!,I can't believe it! Look at you go!,Unbelievable! Four right! Simply unbelievable!";
$temp[4]="All of them! Yes!,How do you do it? Simply magic!  All right!, Bravo!  Bravo!  Bravo!  Bravo! Bravo! Five cheers--hooray!,Simply...truly...absolutely--INCREDIBLE!!!,Clearly there's no stopping you!  Amazing.  Way to go!!!";
$temp[5]="Not quite.,Nope.,Don't see that one.,Try again.,No.,Not this time.,Think again.,No good.,Not on the board.";
$temp[6]="Give this one a shot!,New question!,How about giving this one a try?,Try this one out!,Give it a go.,Moving along--new round!,Okay new round.,Another question.,New question.,Here's another round.,Here's a new question.,Time to give a new one a try.";
$temp[7]="Below are the answers for the previous round...";
$temp[8]="Welcome to the game!  I'm your host and we'll begin in just a few seconds.<br><br>
		(the game will automatically start...)";
$temp[9]="Try a different one.";
	$hold=explode(",",$temp[$caller]);
	shuffle($hold);
	if ($caller==4)
		$out=$hold[0]."<br><br>".$temp[7];
	else
		$out=$hold[0];

	echo "<span style=\"color: #800000;\"><img src=\"host.gif\" align=\"left\">$out</span>";


}

?>
