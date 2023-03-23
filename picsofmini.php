<?php 
include("./header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Image Gallery</title>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 10px;
            margin: 10px;
        }

        .gallery img {
            width: 100%;
            height: auto;
        }

        .weekly-miniature {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
        }

        .weekly-miniature img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
<div class="gallery">
    <img src="./pics of minitures/666 jambo/starwars.png" alt="Image 1">
    <img src="pics of minitures/crow j simpson/received_679877240484658.jpg" alt="Image 2">
    <img src="Logo/DGlogo3.jpg" alt="Image 3">
    <img src="image-4.jpg" alt="Image 4">
    <img src="image-5.jpg" alt="Image 5">
    <img src="image-6.jpg" alt="Image 6">
    <img src="image-7.jpg" alt="Image 7">
    <img src="image-8.jpg" alt="Image 8">
    <img src="image-9.jpg" alt="Image 9">
    <img src="image-10.jpg" alt="Image 10">
</div>

<div class="weekly-miniature">
    <img src="pics of minitures/crow j simpson/PXL_20230113_184651893.jpg" alt="Miniature of the Week">
</div>
</body>
</html>
<?php
include("./footer.php");
?>
