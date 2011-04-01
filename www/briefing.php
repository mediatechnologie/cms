<?php
$project_naam  =  'voor het project';
?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Briefing <?php echo $project_naam; ?></title>
		<meta name="author" content="immeëmosol http://p.willfris.nl/" />

		<link href="/_styles/nn4.css" rel="stylesheet" type="text/css" />
		<style type="text/css">@import url("/_styles/real.css");</style>
		<style type="text/css">
<!--/*--><![CDATA[/*><!--*/
body
	{
		/* *
		background-color  :  #333333;
		color  :  #CCCCCC;
		/* */
		font-family  :  sans-serif;
	}
p , ul , ol
	{
		max-width  :  60ex;
	}
/*]]>*/-->
		</style>
		<script type="text/javascript">
<!--//--><![CDATA[//><!--
//--><!]]>
		</script>
	</head>
	<body>
		<h1>Briefing <?php echo $project_naam; ?></h1>
		<p>
		</p>
		<h2>
			Wie is de opdrachtgever?
		</h2>
		<p>
			Instituut brookman,
				een organisatie voor
					huiswerkbegeleiding,
					studiebegeleiding en
					privélessen.
		</p>
		<h2>
			Wat en waarom?
		</h2>
		<h3>
			Wat
		</h3>
		<p>
			Een website bestaande uit vier pagina's, te weten:
				hoofdpagina,
				contactpagina,
				testimonialspagina en
				tips'n'trucs-pagina.
			En een beheergedeelte specifiek gemaakt voor deze paginas.

			Voornaamste oplevering is het beheergedeelte van de website en de 
			bijbehorende gegevensopslag.
		</p>
		<h3>
			en waarom?
		</h3>
		<p>
			Om zo een on-line weergave te hebben van het bedrijf.
			En om eventuele nieuwe gegevens( of hernieuwd inzicht) in de wervende 
			teksten(en) op eenvoudige wijze aan te kunnen passen vanuit een 
			beveiligde omgeving die toegankelijk is voor een vaste set van 
			personen.
			Zo heeft de website een altijd actuele uitstraling ten behoeve van 
			klantenwerving.
		</p>
		<!--p>
			Mocht er genoeg tijd zijn dan kan de vaste set van personen wellicht 
			ook beheerd/onderhouden worden vanuit de web-interface.
		</p-->
		<h2>
			Voor wie en hoe?
		</h2>
		<h3>
			Voor wie
		</h3>
		<p>
			Het beheergedeelte zal gebruikt worden door één of meerdere 
			medewerkers van het bedrijf.
			De beheer-interface zal duidelijk te begrijpen worden en de gebruiker 
			ervan op natuurlijke wijze sturen naar een focus op het overdragen van 
			de informatie.
		</p>
		<p>
			De voorkant van de website is bedoeld voor nieuwe `klanten` van het 
			instituut.
			Het deel van de website dat gebruikt kan worden om de route te plannen 
			kan ook door huidige klanten gebruikt worden.
		</p>
		<h3>
			en hoe?
		</h3>
		<h4>
			Publieke site
		</h4>
		<p>
			De publieke site bestaat uit vier templates/sjablonen die de laatst 
			ingevoerde gegevens weergeven.
			Deze templates dienen zo gemaakt te worden dat deze door een 
			beginnende webontwikkelaar kan worden aangepast.
		</p>
		<h4>
			Beheergedeelte
		</h4>
		<p>
			Het beheergedeelte van deze applicatie werkt zoveel mogelijk met 
			standaarden. Het werken met deze standaarden heeft als voordeel dat de 
			applicatie eventueel makkelijker uit te breiden zal zijn. Er word op 
			deze manier dus rekening gehouden met eventuele groei binnen de 
			organisatie.
		</p>
		<p>
			Verder is het voordel van werken met standaarden dat in het geval van 
			overdracht aan andere partijen, deze partijen sneller inzicht kunnen 
			krijgen in de opzet van de applicatie.
		</p>
		<dl>
			<dt>
				Gekozen standaarden
			</dt>
			<dd>
				<ul>
					<li>
						xml valide html
						, door de html xml-valide te schrijven blijft de mogelijkheid 
						open staan om de webpagina te gebruiken in een xml-programma.
					</li>
					<li>
						unobtrusive javascript
						, deze vorm van javascript typen biedt extra mogelijkheden 
						aan de gebruiker wanneer de browser deze extra's ondersteund.
						Indien de browser de mogelijkheden niet ondersteund zal de 
						gebruiker minder mogelijkheden zien, maar nooit 
						geconfronteerd worden met niet werkende javascriptonderdelen 
						in de webpagina.
					</li>
					<li>
						css met zo min mogelijk browser-hacks
						, browsers die bepaalde css niet ondersteunen hebben een iets 
						minder fraaie weergave maar doet geen afbreuk aan de 
						toegankelijkheid/bereikbaarheid van de weer te geven 
						informatie.
					</li>
					<li>
						<abbr title="Representational State Transfer">REST</abbr>-aanpak
						elke uri vertegenwoordigd een bepaalde resource(
								een `entiteit`/object waar interactie mee plaatsvind)
					</li>
					<li>
						<dl>
							<dt>
								<abbr title="Hyper Text Transfer Protocol">
								HTTP</abbr>-digest
								authentication
							</dt>
							<dd>
								een in de http-rfc vastgelegde vorm van authenticatie 
								van gebruikers. Ten opzichte van de basic 
								http-authentication is deze techniek zo opgesteld dat 
								het wachtwoord van de gebruiker niet in plain-text( 
										platte tekst) verstuurd word.
							</dd>
						</dl>
						Deze vorm van authenticatie sluit nauw aan bij REST.
					</li>
				</ul>
			</dd>
		</dl>
		<p>
			Het beheergedeelte bestaat uit vijf onderdelen, te weten:
			<!--
				Mocht er genoeg tijd over zijn, dan valt er aan te denken om de 
				rechten van de beherende gebruikers specifieker op te splitsen.
				De hoofdbeheerder mag bijvorbeeld wel het adres van de organisatie 
				aanpassen maar niet de testimonials.
				De hoofdbeheerder mag/kan beheerders toevoegen aan het systeem.
			-->
		</p>
		<ol>
			<li>
				beheer van de tekst en titel op de hoofdpagina
			</li>
			<li>
				beheer van de contactinformatie;
					adres<!-- voor de routeplanner -->,
					e-mailadres,
					telefoonnummer
			</li>
			<li>
				beheer van de testimonials:
				een overzicht van alle testimonials
				waarin
					elke testimonial op diezelfde pagina individueel te wijzigen is
				en een testimonial toe te voegen is,
				wanneer een nieuw toegevoegd testimonial onjuist is kan er geen 
				nieuwe worden toegevoegd tot de onjuiste verwijderd of 
				kloppend/juist gemaakt is.
				een testimonial bestaat uit de volgende gegevens:
					de opdrachtgever,
					de link naar een voorbeeld of online locatie van de opdrachtgever
					het testimonial dat door de opdrachtgever gegeven is,
						of een deel daarvan( tekst met weinig opmaak)
			</li>
			<li>
				beheer van tips'n'trucs/links pagina:
				vergelijkbaar met testimonials
				alleen gaat het nu om de volgende informatie:
					selectiebox; waar gaat het om, een tip, truc of link?
					optionele titel voor tip, truc of link
					beschrijving van de tip, truc of link
					een optionele link, wanneer type link is gekozen niet optioneel
			</li>
			<li>
				beheer van de site-gegevens;
					beschrijving website,
					sleutelwoorden van website.
			</li>
		</ol>



		<h1 id="plan_van_aanpak">Plan van aanpak <?php
	echo $project_naam;
?></h1>
		<p>
			Het project word gemaakt in een proces van maken en testen
			en loopt
			van 2011-03-07, 7 maart<!--02-28--> t/m. 1 april 2011
			.
		</p>
		<table>
			<thead>
				<tr>
					<th>
						fase
					</th>
					<th>
						week#( dag v. mnd.)
					</th>
					<th>
						actie(s)
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						0
					</td>
					<td>
						9
					</td>
					<td>
						briefing, debriefing, plan van aanpak
					</td>
				</tr>
				<tr>
					<td>
						0
					</td>
					<td>
						10
					</td>
					<td>
						briefing, debriefing, plan van aanpak
					</td>
				</tr>
				<tr>
					<td>
						0
					</td>
					<td>
						11, 13
					</td>
					<td>
						briefing,
						plan van aanpak /
						planning
					</td>
				</tr>
				<tr>
					<td>
						0
					</td>
					<td>
						11, 17
					</td>
					<td>
						briefing,
						plan van aanpak /
						planning
					</td>
				</tr>
				<tr>
					<td>
						1
					</td>
					<td>
						11
					</td>
					<td>
						functioneel ontwerp,
						eerste proefoplevering
						maken systeem
					</td>
				</tr>
				<tr>
					<td>
						2
					</td>
					<td>
						12
					</td>
					<td>
						eerste oplevering
					</td>
				</tr>
				<tr>
					<td>
						3
					</td>
					<td>
						13, 1
					</td>
					<td>
						laatste oplevering
						met correcties
						en verbeteringen
						doorgevoerd
					</td>
				</tr>
			</tbody>
		</table>
<!--
Het watervalmodel bestaat uit de volgende fasen:
Definitiestudie/analyse. Er wordt onderzoek gedaan naar en gebrainstormd over de software om duidelijk te krijgen wat het doel is van de software.
Basisontwerp. Er wordt duidelijker uitgewerkt wat er tijdens de eerste fase naar boven is gekomen. In deze fase worden de wensen van de klant op papier gezet en wordt al gedacht aan de vorm van het programma. In deze fase wordt vastgelegd wat het op te leveren systeem moet doen.
Technisch ontwerp/detailontwerp. Aan de hand van het basisontwerp kan er een werkelijk programma uitgedacht worden. In deze fase wordt vastgelegd hoe de in het basisontwerp vastgelegde functionaliteit gerealiseerd gaat worden. Nu vindt ook een onderverdeling plaats in technische eenheden zoals programma's, modules en functies.
Bouw/implementatie. Hier wordt de broncode van de programma's geschreven.
Testen. Er wordt gecontroleerd of de software goed volgens de ontwerpen is gebouwd. Ook kunnen er in deze fase fouten boven water komen die al in eerdere stadia gemaakt zijn.
Integratie. Het systeem is klaar en getest. Toch zal het nog in het bedrijf in gebruik genomen moeten worden. Dat wordt gedaan in deze fase.
Beheer en onderhoud. Om er voor te zorgen dat het systeem het blijft doen zal er onderhoud verricht moeten worden.
Het watervalmodel bestaat uit verschillende fasen. Iedere fase heeft een eigen niveau dat tevens de volgorde bepaalt. Het hoogste niveau wordt als eerste uitgevoerd en vervolgens de lagere fasen. Dit is gelijk aan de natuurlijke werking van een waterval en vandaar ook de naam. Hierboven is goed te zien dat de verschillende fasen van boven naar beneden lopen.
-->
<!--
fases zijn deprecated¿;
wanneer uit de evaluatie een aanpassing blijkt,
		  word die aanpassing doorgevoerd, da's dan toch weer realisatie... :s ?
-->
		<!--<hgroup>-->
			<h2>Fase 0</h2>
			<!--<h3>-->
				<!--Vooronderzoek en opstartfase-->
			<!--</h3>-->
			<!--<h4>-->
				<!--<abbr lang="en" title="also known as">a.k.a.</abbr>-->
				<!--Initiatie-, Definitie-, Ontwerp-, Voorbereidings- fase-->
			<!--</h4>-->
		<!--</hgroup>-->
		<ul>
			<li>
				wat is de deployment-omgeving?
				welke webserver word er gebruikt, databaseserver, 
				programmeertalen/scripttalen?
			</li>
			<li>
				voor welk publiek is het product bedoeld, in andere woorden: 
				met welke soort computerprogramm's zijn zij bekend?
				zijn er eisen aan de leesbaarheid?
			</li>
			<li>
				is zoekmachine-optimalisering gewenst?
			</li>
			<li>
				kunnen er al initiële gegevens worden overhandigd?
			</li>
		</ul>
		<p>
			Aan het eind van deze fase is er overeenstemming omtrent het op te 
			leveren product.
		</p>

		<!--<hgroup>-->
			<h2>Fase 1</h2>
			<!--<h3>Opstart-, Realisatiefase</h3>-->
			<!--<h4>Ontwerp-, Realisatiefase</h4>-->
		<!--</hgroup>-->
		<ul>
			<li>
				De verschillende paginasjablonen
				worden uitgewerkt in statische html
			</li>
			<li>
				De paginas( dynamisch samengevoegde content en paginasjablonen)
				worden uitgewerkt en opgeleverd.
				Indien aangeleverd worden hiervoor de initiële gegevens gebruikt.
			</li>
			<li>
				De mogelijkheden tot gegevensinvoer zijn gemaakt.
			</li>
		</ul>
		<p>
			Aan het eind van deze fase is er een (wellicht incompleet )werkend 
			voorbeeld van het te leveren product.
		</p>

		<!--<hgroup>-->
			<h2>Fase 2</h2>
			<!--<h3>-->
				<!--Realisatiefase-->
			<!--</h3>-->
		<!--</hgroup>-->
		<ul>
			<li>
				De code word beter gestructureerd.
			</li>
			<li>
				Verbetersuggesties uit de vorige fase worden toegepast.
			</li>
		</ul>
		<p>
			Aan het eind van deze fase is er een werkend product dat voldoet aan 
			de overeengekomen eisen, met uitzondering de kleine correcties die 
			gemaakt worden aan de hand van de nazorgslag.
		</p>

		<!--<hgroup>-->
			<h2>Fase 3</h2>
			<!--<h3>Eindfase</h3>-->
			<!--<h4>Realisatie-, Nazorgfase</h4>-->
		<!--</hgroup>-->
		<ul>
			<li>
				De presentatie word voorbereid
			</li>
			<li>
				Verbetersuggesties uit de vorige fase worden toegepast.
			</li>
			<li>
				De code word op zijn bestemming geplaatst.
			</li>
		</ul>
		<p>
			Oplevering van het verzorgde eindproduct,
			wijzigingen danwel aanpassingen m.b.t. het product
			leiden op dit moment tot een nieuwe opdracht
			en zodoende ook tot een nieuwe overeenkomst qua vergoeding.
		</p>

	</body>
</html>

