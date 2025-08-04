<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title><?=$title?></title>
    <meta name="description" content="<?=($description ?? '')?>">
  </head>
  <body>
    <header>
    <?php if(isset($_SERVER['PATH_INFO'])):?>
    <a href="/"><img src="/logo.webp" alt="NanoMVC" width="287" height="110"></a>
    <?php else:?>
    <img src="/logo.webp" alt="NanoMVC" width="287" height="110">
    <?php endif?>
    </header>

    <div class="container">
