<?php

$url = $_GET['url'] ?? '';
$params = $_GET['params'] ?? [];

if (!$url) {
    die("No url");
}

// Check for ?v=videoid or /embed/videoid

$parts = parse_url($url);
$videoid = null;
$query = $parts["query"] ?? "";
$path = $parts["path"] ?? "";
if (strpos($query, "v=") === 0) {
    $result = null;
    parse_str($query, $result);
    $videoid = $result['v'] ?? '';
}

if (!$videoid && strpos($path, 'embed') === 0) {
    $pathParts = explode("/", $parts, 10);
    $videoid = $pathParts[1] ?? '';
}

if (!$videoid) {
    die("No video id in url $url");
}

$cacheSeconds = 3600 * 24 * 365;
$queryParams = '';
if (!empty($params)) {
    $normalizedParams = [];
    foreach ($params as $k => $v) {
        $normalizedParams[$v] = 1;
    }
    $queryParams = '?' . http_build_query($normalizedParams);
}

header("Access-Control-Allow-Origin: *");
header("Cache-Control: max-age=0, s-maxage=$cacheSeconds");

$html = <<<HTML
<div class="iframe-container">
    <iframe src="https://lite-youtube-embed-iframe.vercel.app/embed/{$videoid}{$queryParams}" loading="lazy"></iframe>
</div>
HTML;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lite YouTube embed frame</title>
    <link rel="stylesheet" href="node_modules/lite-youtube-embed/src/lite-yt-embed.css" />
    <script defer src="node_modules/lite-youtube-embed/src/lite-yt-embed.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/mvp.css">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23d0021b%22></rect><path fill=%22%23fff%22 d=%22M72.59 25.21L72.59 25.21Q72.59 26.20 71.24 29.03Q69.89 31.87 67.46 36.10Q65.03 40.33 61.66 45.73Q58.28 51.13 54.23 57.16L54.23 57.16L54.23 77.22Q53.78 77.41 52.83 77.63Q51.89 77.86 50.90 77.86L50.90 77.86Q46.94 77.86 46.94 74.53L46.94 74.53L46.94 57.16Q44.42 53.47 41.77 49.33Q39.11 45.19 36.50 40.96Q33.89 36.73 31.55 32.68Q29.21 28.63 27.41 25.03L27.41 25.03Q27.77 24.04 28.76 23.09Q29.75 22.15 31.37 22.15L31.37 22.15Q33.08 22.15 34.02 23.05Q34.97 23.95 35.96 25.75L35.96 25.75Q37.40 28.27 39.34 31.69Q41.27 35.11 43.30 38.62Q45.32 42.13 47.21 45.41Q49.10 48.70 50.45 50.86L50.45 50.86L50.81 50.86Q55.49 43.03 59.14 36.28Q62.78 29.53 66.38 22.78L66.38 22.78Q66.92 22.42 67.69 22.28Q68.45 22.15 69.17 22.15L69.17 22.15Q72.59 22.15 72.59 25.21Z%22></path></svg>" />
    <script>
        function copyTextToClipboard(text) {
            var textArea = document.createElement("textarea");

            textArea.style.position = 'fixed';
            textArea.style.top = 0;
            textArea.style.left = 0;
            textArea.style.width = '2em';
            textArea.style.height = '2em';
            textArea.style.padding = 0;
            textArea.style.border = 'none';
            textArea.style.outline = 'none';
            textArea.style.boxShadow = 'none';
            textArea.style.background = 'transparent';
            textArea.value = text;

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }

            document.body.removeChild(textArea);
        }
    </script>
</head>

<body>
    <header>
        <h1>Lite YouTube embed frame</h1>
    </header>
    <main>
        <h2>Copy paste the following html</h2>
        <pre id="code"><?= htmlentities($html); ?></pre>
        <button onclick="copyTextToClipboard(document.querySelector('#preview').innerHTML)">Copy to clipboard</button>
        <h2>Preview</h2>
        <div id="preview"><?= $html ?></div>

        <br>
        <br>
        <a href="/">Go back</a>
    </main>
</body>

</html>