<?php

$title = $_GET['title'] ?? '';
$videoid = $_GET['video_id'] ?? '';
$params = $_GET['params'] ?? '';
$player = "<!-- no video id -->";
if ($videoid) {
    $player = <<<PLAYER
<lite-youtube videoid="$videoid" params="$params" style="background-image: url('https://i.ytimg.com/vi/$videoid/hqdefault.jpg">
<button type="button" class="lty-playbtn">
    <span class="lyt-visually-hidden">$title</span>
</button>
</lite-youtube>
PLAYER;
}

$html = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="stylesheet" href="node_modules/lite-youtube-embed/src/lite-yt-embed.css" />
    <script src="node_modules/lite-youtube-embed/src/lite-yt-embed.js"></script>
    <style type="text/css">
    *{padding:0;margin:0;overflow:hidden}
    html,body{height:100%}
    </style>
</head>
<body>
$player
</body>
</html>
HTML;

header("Access-Control-Allow-Origin: *");
echo $html;
