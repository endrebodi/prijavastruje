<!doctype html>
<html class="no-js" lang="sr">
<head>
<meta charset="utf-8">
<title>Prijavi struju</title>
<meta name="description" content="Prijavite stanje na brojilu samo jednim klikom.">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="">
<meta property="og:type" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<link rel="apple-touch-icon" href="icon.png">
<link rel="stylesheet" href="css/style.css">
<meta name="theme-color" content="#fafafa">
</head>

<body>

<?php

    if ($_POST) {

			$izabranoPodrucje = $_POST['distributivnoPodrucje'];
			
			switch ($izabranoPodrucje) {
				
				case 'beograd':
					$mailDistributivnogPodrucja = 'info.centar@epsdistribucija.rs';
					break;
				
				case 'vojvodina':
					$mailDistributivnogPodrucja = 'prijavastanja.ev@eps.rs';
					break;
				
				case 'kraljevo':
					$mailDistributivnogPodrucja = 'prijavastanja.kv@eps.rs';
					break;
				
				case 'kragujevac':
					$mailDistributivnogPodrucja = 'prijava.stanja.kg@eps.rs';
					break;
				
				case 'nis':
					$mailDistributivnogPodrucja = 'stanja.jugoistok@eps.rs';
					break;

			}
			
			$imeIprezime = $_POST['imeIprezime'];
			
			$adresa = $_POST['adresa'];
			
			$edBroj = $_POST['edBroj'];
			
			$stanjeNaBrojilu = $_POST['stanjeNaBrojilu'];
			
			$brojBrojila = $_POST['brojBrojila'];
			
			if ($brojBrojila != '') {
				$brojBrojila = "\n Broj brojila: " . $_POST['brojBrojila'];
			}
			
			$datumOcitavanja = $_POST['datumOcitavanja'];
			
			$datumOcitavanja = date("d.m.Y", strtotime($datumOcitavanja));  
			
			$emailkorisnika = $_POST['emailkorisnika'];
			
			if ($emailkorisnika != '') {
				$emailkorisnika = "\n Email korisnika: " . $_POST['emailkorisnika'];
			}
            
            $primalac = $mailDistributivnogPodrucja; // Mail podrucja, bira se iz dropdowna

			$naslov = "Prijava stanja za ED broj " . $edBroj; // Naslov maila

			$tekstEmaila = "Ime i prezime: " . $imeIprezime . "\n Adresa: " . $adresa . "\n ED broj: " . $edBroj . $brojBrojila . "\n Stanje na brojilu: " . $stanjeNaBrojilu . "\n Datum očitavanja: " . $datumOcitavanja . $emailkorisnika;

			$posiljalac = "From: server@prijavistruju.com"; // Email korisnika

			if (mail($primalac, $naslov, $tekstEmaila, $posiljalac)) {
				
				echo "<div style='padding: 0.2rem; text-align: center; letter-spacing: 0.05rem; color: #fafafa; background-color: green;'><p>Stanje je uspešno prijavljeno, ukoliko želite izvršiti još prijava, ponovite postupak</p></div>";
				
			} else {
				
				echo "<div style='padding: 0.2rem; text-align: center; letter-spacing: 0.05rem; color: #fafafa; background-color: #ac0000;'><p>Prijava nije uspela, proverite da li ste popunili sva polja označena zvezdicom i pokušajte ponovo</p></div>";
				
			}

    }

?>

<header>

	<div class="uvod">

		<h1>Prijavi struju</h1>

		<p>Brže i jednostavnije<br />
		od ispisivanja stanja na papir ili pozivanja EPS-a telefonom</p>
		<p>Popunite polja ispod i kliknite na dugme <span style="padding: 0 0.3rem; border-bottom: 2px solid #ac0000;">Pošalji</span> ,<br />
		to je sve</p>

	</div>

</header>

<div class="container">

	<form method="post">
		
		<p>
			<label for="distributivnoPodrucje">Distributivno područje <span class="zvezda">*</span></label>
		</p>
		<p>
			<select id="distributivnoPodrucje" class="minimal" name="distributivnoPodrucje">
				<option value="beograd">Beograd</option>
				<option value="vojvodina">Vojvodina</option>
				<option value="kraljevo">Kraljevo</option>
				<option value="kragujevac">Kragujevac</option>
				<option value="nis">Niš</option>
			</select>
		</p>
		
		<p>
			<label for="imeIprezime">Ime i prezime <span class="zvezda">*</span></label>
		</p>
		<p>
			<input type="text" name="imeIprezime" placeholder="Petar Petrović" onfocus="this.placeholder = '' ">
		</p>
		
		<p>
			<label for="adresa">Adresa <span class="zvezda">*</span></label>
		</p>
		<p>
			<input type="text" name="adresa" placeholder="Bulevar Nikole Tesle 10, stan 4, 11070 Beograd" onfocus="this.placeholder = '' ">
		</p>
		
		<p>
			<label for="edBroj">ED broj <span class="zvezda">*</span></label>
		</p>
		<p>
			<input type="number" name="edBroj" placeholder="4171002254" onfocus="this.placeholder = '' ">
		</p>
		
		<p>
			<label for="brojBrojila">Broj brojila <span style="color: #555555">(uneti samo ukoliko posedujete više brojila, polje nije obavezno)</span></label>
		</p>
		<p>
			<input type="number" name="brojBrojila" placeholder="0" onfocus="this.placeholder = '' ">
		</p>
		
		<p>
			<label for="stanjeNaBrojilu">Stanje na brojilu <span class="zvezda">*</span></label>
		</p>
		<p>
			<input type="number" name="stanjeNaBrojilu" placeholder="90563" onfocus="this.placeholder = '' ">
		</p>
		
		<p>
			<label for="datumOcitavanja">Datum očitavanja <span style="color: #555555">(izaberite klikom iz kalendara)</span> <span class="zvezda">*</span></label>
		</p>
		<p>
			<input id="datumOcitavanja" type="date" name="datumOcitavanja">
		</p>
		
		<p>
			<label for="email">Vaša email adresa <span style="color: #555555">(polje nije obavezno)</span></label>
		</p>
		<p>
			<input type="email" name="emailkorisnika" placeholder="petarpetrovic@gmail.com">
		</p>
		
		<p>
			<input type="submit" value="Pošalji" class="posalji">
		</p>

	</form>

</div>

<footer>

<p>Za više informacija kontaktirajte administraciju putem emaila <span style="color: #2d638b">administracija [at] prijavistruju.com</span><br /> &copy; prijavistruju.com, sva prava zadržana</p>

</footer>

<script>
	var field = document.querySelector('#datumOcitavanja');
	var date = new Date();
	// Podesi danasnji datum 
	field.value = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2, 0) + '-' + date.getDate().toString().padStart(2, 0);
</script>

</body>

</html>
