<?php session_start();if (isset($_SESSION['USR_LOGIN'])=="") {	header("Location:login.php");}
include("mytcg/settings.php");
include("$header");
if(!$_SERVER['QUERY_STRING']) {
	$select = mysql_query("SELECT * FROM `$table_members` WHERE email='$_SESSION[USR_LOGIN]'");
	while($row=mysql_fetch_assoc($select)) {
		?>
		<h1>Member card form</h1>
		<form method="post" action="forms_mc.php?thanks">
		<input type="hidden" name="id" value="<?php echo $row[id]; ?>" />
		<input type="hidden" name="name" value="<?php echo $row[name]; ?>" />
		<table>
		<tr><td>Color:</td><td><select name="color">
		<option value="">-----</option>
		<option value="Blue">Blue</option>
		<option value="Brown">Brown</option>
		<option value="Green">Green</option>
		<option value="Orange">Orange</option>
		<option value="Pink">Pink</option>
		<option value="Purple">Purple</option>
		<option value="Red">Red</option>
		<option value="Yellow">Yellow</option>
		<option value="Surprise">Surprise me!</option>
		<option value="Using old card">I want to use my old card</option>
		</select></td></tr>
		<tr><td>Image</td><td><input type="text" name="url" id="url" value="" placeholder="http://" />
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value=" Level Up! " /></td></tr>
		</table>
		</form>
		<?php
	}
}

elseif($_SERVER['QUERY_STRING']=="thanks") {
	if (!isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] != "POST") {
		exit("<p>You did not press the submit button; this page should not be accessed directly.</p>");
	}
	else {
		$exploits = "/(content-type|bcc:|cc:|document.cookie|onclick|onload|javascript|alert)/i";
		$profanity = "/(beastial|bestial|blowjob|clit|cum|cunilingus|cunillingus|cunnilingus|cunt|ejaculate|fag|felatio|fellatio|fuck|fuk|fuks|gangbang|gangbanged|gangbangs|hotsex|jism|jiz|kock|kondum|kum|kunilingus|orgasim|orgasims|orgasm|orgasms|phonesex|phuk|phuq|porn|pussies|pussy|spunk|xxx)/i";
		$spamwords = "/(viagra|phentermine|tramadol|adipex|advai|alprazolam|ambien|ambian|amoxicillin|antivert|blackjack|backgammon|holdem|poker|carisoprodol|ciara|ciprofloxacin|debt|dating|porn)/i";
		$bots = "/(Indy|Blaiz|Java|libwww-perl|Python|OutfoxBot|User-Agent|PycURL|AlphaServer)/i";
		
		if (preg_match($bots, $_SERVER['HTTP_USER_AGENT'])) {
			exit("<h1>Error</h1>\nKnown spam bots are not allowed.<br /><br />");
			}
			foreach ($_POST as $key => $value) {
				$value = trim($value);
				if (empty($value)) {
					exit("<h1>Error</h1>\nEmpty fields are not allowed. Please go back and fill in the form properly.<br /><br />");
				}
				elseif (preg_match($exploits, $value)) {
					exit("<h1>Error</h1>\nExploits/malicious scripting attributes aren't allowed.<br /><br />");
				}
				elseif (preg_match($profanity, $value) || preg_match($spamwords, $value)) {
					exit("<h1>Error</h1>\nThat kind of language is not allowed through our form.<br /><br />");
				}
				
				$_POST[$key] = stripslashes(strip_tags($value));
			}
			
			$id = htmlspecialchars(strip_tags($_POST['id']));
			$name = htmlspecialchars(strip_tags($_POST['name']));
			$color = htmlspecialchars(strip_tags($_POST['color']));
			$url = htmlspecialchars(strip_tags($_POST['url']));
			
			$insert = "INSERT INTO `$table_mcs` (`id`, `member`, `color`, `image`) VALUE ('', '$name', '$color', '$url')";
			mysql_query($insert, $connect) or die(mysql_error());
					?>
					<h1>Sent!</h1>
					Your request has been added to the database; you should receive your member card soon!
<?php				}
			}
			else {
				?>
				<h1>Error</h1>
				It looks like there was an error in processing your member card request form. Send the information to <?php echo $tcgemail; ?> and we will send you your rewards ASAP. Thank you and sorry for the inconvenience.
				<?php
			}
include("$footer"); ?>
