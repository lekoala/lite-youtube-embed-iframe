<?php

$videoid = REQUEST_PARTS[1] ?? '';

// Check if there is an id
if (!$videoid) {
    http_response_code(404);
    die('No video id');
}

// Validate id
$isValid = preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoid) > 0;
if (!$isValid) {
    http_response_code(404);
    die('Invalid video id');
}

try {
    // Get embed infos
    $embed = new \Embed\Embed();

    $info = $embed->get('https://www.youtube.com/watch?v=' . $videoid);
} catch (Exception $ex) {
    http_response_code(500);
    die($ex->getMessage());
}

$cacheSeconds = 3600 * 24 * 365;
$title = $info->title;

$params = $_GET ?? [];

header("Access-Control-Allow-Origin: *");
header("Cache-Control: max-age=0, s-maxage=$cacheSeconds");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script defer src="/assets/lite-yt-embed.min.js"></script>
    <style type="text/css">
        * {
            padding: 0;
            margin: 0;
            overflow: hidden
        }

        html,
        body {
            height: 100%
        }

        lite-youtube {
            background-color: #000;
            position: relative;
            display: block;
            contain: content;
            background-position: center center;
            background-size: cover;
            cursor: pointer;
            max-width: 720px;
        }

        lite-youtube::before {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAADGCAYAAAAT+OqFAAAAdklEQVQoz42QQQ7AIAgEF/T/D+kbq/RWAlnQyyazA4aoAB4FsBSA/bFjuF1EOL7VbrIrBuusmrt4ZZORfb6ehbWdnRHEIiITaEUKa5EJqUakRSaEYBJSCY2dEstQY7AuxahwXFrvZmWl2rh4JZ07z9dLtesfNj5q0FU3A5ObbwAAAABJRU5ErkJggg==);
            background-position: top;
            background-repeat: repeat-x;
            height: 60px;
            padding-bottom: 50px;
            width: 100%;
            transition: all 0.2s cubic-bezier(0, 0, 0.2, 1);
        }

        lite-youtube::after {
            content: "";
            display: block;
            padding-bottom: calc(100% / (16 / 9));
        }

        lite-youtube>iframe {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border: 0;
        }

        lite-youtube>.lty-playbtn {
            width: 68px;
            height: 48px;
            position: absolute;
            cursor: pointer;
            transform: translate3d(-50%, -50%, 0);
            top: 50%;
            left: 50%;
            z-index: 1;
            background-color: transparent;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 68 48"><path fill="%23f00" fill-opacity="0.8" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z"></path><path d="M 45,24 27,14 27,34" fill="%23fff"></path></svg>');
            filter: grayscale(100%);
            transition: filter .1s cubic-bezier(0, 0, 0.2, 1);
            border: none;
        }

        lite-youtube:hover>.lty-playbtn,
        lite-youtube .lty-playbtn:focus {
            filter: none;
        }

        lite-youtube.lyt-activated {
            cursor: unset;
        }

        lite-youtube.lyt-activated::before,
        lite-youtube.lyt-activated>.lty-playbtn {
            opacity: 0;
            pointer-events: none;
        }

        .lyt-visually-hidden {
            clip: rect(0 0 0 0);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }
    </style>
</head>

<body>
    <lite-youtube videoid="<?= $videoid ?>" params="<?= $params ?>" style="background-image: url('https://i.ytimg.com/vi/<?= $videoid ?>/hqdefault.jpg">
        <button type="button" class="lty-playbtn">
            <span class="lyt-visually-hidden"><?= $title ?></span>
        </button>
    </lite-youtube>
</body>

</html>