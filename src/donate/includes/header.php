<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="NES.css is a NES-style CSS Framework." />
    <meta name="keywords" content="html5,css,framework,sass,NES,8bit" />
    <meta name="author" content="© 2018 B.C.Rikko" />
    <meta name="theme-color" content="#212529"/>
    <link rel="shortcut icon" type="image/png" href="favicon.ico">
    <link rel="shortcut icon" sizes="196x196" href="favicon.ico">
    <link rel="apple-touch-icon" href="favicon.ico">

    <title>RETRO.nft</title>

    <link href="https://unpkg.com/nes.css@latest/css/nes.min.css" rel="stylesheet" />
    <link href="./lib/style.css" rel="stylesheet" />
    <script src="./lib/vue.min.js"></script>

    <script src="./lib/dialog-polyfill.js"></script>
    <script src="./lib/highlight.js"></script>
    <?php 
      if (!empty($redirect_url))
        echo "<meta http-equiv=\"refresh\" content=\"11; URL=$redirect_url\">";
    ?>
  </head>

  <body>
    <div id="nescss">
      <header :class="{ sticky: scrollPos > 50 }">
        <div class="container">
          <div class="nav-brand">
            <a href="/">
              <h1><i class="snes-jp-logo brand-logo"></i>RETRO.nft</h1>
            </a>
            <p>No Donation, no NFT.</p>
          </div>
        </div>
      </header>

      <div class="container">
        <main class="main-content">
          <span class="comment-link" :class="{ active:  scrollPos < 300 }">
            <p class="nes-balloon from-right">Donate !</p>
            <i class="nes-mario"></i>
          </span>
