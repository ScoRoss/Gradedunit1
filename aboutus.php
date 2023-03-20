<?php
include("./header.php");
include("./connectdb.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>About Us - Dumfries Gamers</title>
	<style>
		.social-icons {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 20px;
		}

		.social-icons a {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			margin: 0 10px;
			width: 40px;
			height: 40px;
			border-radius: 50%;
			background-color: #eee;
			transition: all 0.3s ease;
		}

		.social-icons a:hover {
			transform: translateY(-3px);
			box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
			background-color: #fff;
		}

		.social-icons img {
			max-width: 100%;
			max-height: 100%;
		}
	</style>
</head>
<body>
	<header>
		<!-- Header content goes here -->
	</header>

	<main>
		<h1>About Us</h1>
		<p>Dumfries Gamers is a tabletop gaming club where like minded geeks get together for fun with analogue games. We meet weekly in Dumfries and host many gaming events throughout the year.</p>

		<p>Our biggest games include most of the Games Workshop lineup - Warhammer 40,000, Age of Sigmar, Blood Bowl and the Horus Heresy - but we also dabble in other war games including Infinity, Marvel Crisis Protocol and various historical games.</p>

		<p>We also have a number of Dungeons and Dragons groups as well as a board game group. We have ‘Game Champions’ for all our gaming systems who both support new players and help teach their respective game, but also organise various narrative campaigns, leagues and tournaments to ensure there is always something for everyone.</p>
        
        <p>Below you can click on a box to get to the desired social meda platform of your choice to see more including a podcast. </p>
		<!-- Social media icons go here -->
		<div class="social-icons">
			<a href="https://www.facebook.com/dumfriesgamers/"><img src="./social media logo/fLogo.png..webp" alt="Facebook"></a>
			<a href="https://www.listennotes.com/podcasts/dumfries-gamers-dumfries-gamers-podcast-6Hc_D3MiuXm/"><img src="./social media logo/dumfries-gamers-NV6WEtMQvwm-6Hc_D3MiuXm.300x300.jpg" alt="podcast"></a>
			<a href="https://www.instagram.com/dumfries_gamers/?hl=en-gb"><img src="./social media logo/igram.png" alt="Instagram"></a>
			<a href="https://www.youtube.com/@dumfriesgamerstv2874"><img src="./social media logo/youtubelogo.png" alt="YouTube"></a>
		</div>
	</main>

	<footer>
		<!-- Footer content goes here -->
	</footer>
</body>
</html>


<?php
include("./footer.php");
?>
