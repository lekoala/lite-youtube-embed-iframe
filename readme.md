# Lite Youtube embed frame

The goal of this minimalistic service is to provide a simple alternative to slow, regular embed from youtube.

For this, we use [Lite Youtube Embed](https://github.com/paulirish/lite-youtube-embed). You don't need to include
it on your app (that's always 6kb of js and 3kb of css saved) because you will be including the iframe in our app
that is hosted on vercel.

## How to use

Simply replace your Youtube embeds with this:

```html
<div class="iframe-container">  
<iframe
    src="https://lite-youtube-embed-iframe.vercel.app/?video_id=ogfYd705cRs&title=This%20Is%20My%20Url%20Encoded%20Title&params=controls%3D0"
    loading="lazy"></iframe>
</div>
```

Supported query parameters:
- video_id (required)
- title (optional) : the title of your video
- params (optional) : additional params to pass to the player

These parameters need to be [url encoded](https://url-decode.com/)

## Good to know

The response is cached for 1 year. If you want to see an uncached version, you can simply query use
?_vercel_no_cache=1 in the request parameters.

## Recommended css

Don't forget to make your iframe container responsive using something like this

```css
.iframe-container {
  overflow: hidden;
  /* 16:9 aspect ratio */
  padding-top: 56.25%;
  position: relative;
}

.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
```