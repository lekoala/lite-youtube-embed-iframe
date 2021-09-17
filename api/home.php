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
</head>

<body>
    <header>
        <h1>Lite YouTube embed frame</h1>
    </header>
    <main>
        <h2>Compare</h2>
        <ul>
            <li><a href="/demo/lite">Using our lite embed</a></li>
            <li><a href="/demo/regular">Using the regular embed</a></li>
        </ul>

        <h2>How to use</h2>
        <p>Simply paste the video url here</p>
        <form action="/generate">
            <label for="input-url">Url of the video</label>
            <input type="text" name="url" id="input-url" required>
            <p>Player controls (<a href="https://developers.google.com/youtube/player_parameters#Parameters">see valid options</a>)</p>
            <label><input type="checkbox" name="params[]" value="autoplay"> autoplay</label>
            <label><input type="checkbox" name="params[]" value="controls"> controls</label>
            <label><input type="checkbox" name="params[]" value="loop"> loop</label>
            <input type="submit">
        </form>
    </main>
</body>

</html>