<?php
if (!empty($_GET['q'])) {
  switch ($_GET['q']) {
    case 'info':
      phpinfo();
      exit;
      break;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laragon</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="https://i.imgur.com/ky9oqct.png" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    :root {
      --primary: hsl(204, 100%, 61%);
      --primary--hover: hsl(204, 100%, 51%);
      --light: #f5f5f5;
    }

    *,
    :before *,
    :after * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-weight: 100;
      font-family: 'Karla';
      font-size: large;
    }

    header,
    main,
    nav,
    aside {
      margin: 1rem auto;
      max-width: 1200px;
      text-align: center;
    }


    header {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    h1 {
      font-size: 5rem;
    }



    a {
      color: var(--primary);
      font-weight: 900;
      text-decoration: none;
    }

    a:hover {
      color: var(--primary--hover);
      font-weight: 900;
      transition: 300ms;
    }

    main a {
      color: grey;
    }


    .alert {
      color: red;
      font-weight: 900;
    }

    .info {
      padding: 1rem;
      background-color: var(--light);

    }
    .php-my-admin {
      padding: 1rem;

    }
    .php-my-admin__link {
      display: inline-block;
      padding: 1rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .php-my-admin__link > * {
      margin: 0 0.2rem;
    }
    .header__item {
      margin: 0;
      padding: 1rem;
    }

    .header--logo {
      height: 8rem;
    }

    /* ul,
    li {
      border: 2px dashed grey;
    } */

    .project__ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: grid;
      grid-template-columns: repeat( auto-fit, minmax(250px, 1fr) );
      grid-gap: 1rem;
      /* display: flex;
      flex-wrap: wrap;
      gap: 0.5rem; */
    }

    .project__li {
      display: block;
      /* flex: 0 1 250px; */
      min-height: 3rem;
      background-color: var(--light);
    }

    .project__link {
      display: block;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .project__link > * {
      margin: 0 0.4rem;
    }


    @media (min-width: 650px) {
      h1 {
        font-size: 10rem;
      }
    }
  </style>
</head>

<body>
  <header>
    <img class="header__item header--logo" src="https://i.imgur.com/ky9oqct.png" alt="Offline">
    <h1 class="header__item header--title" title="Laragon">Laragon</h1>
  </header>
  <main>
    <div class="info">
      <p>
        <?php print($_SERVER['SERVER_SOFTWARE']); ?>
      </p>
      <p>
        PHP version: <?php print phpversion(); ?> <span><a title="phpinfo()" href="/?q=info">info</a></span>
      </p>
      <p>
        Document Root: <strong><i class="fas fa-folder-open"></i> <?php print($_SERVER['DOCUMENT_ROOT']); ?></strong>
      </p>
      <p>
        <a title="Getting Started" href="https://laragon.org/docs" target="_blank">Getting Started</a>
      </p>
    </div>
    <?php
    $phpMyAdmin = 'http://localhost/phpmyadmin/';
    $file_headers = @get_headers($phpMyAdmin);
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') :
      $exists = false;
    ?>
      <div class="php-my-admin">
        <p class="alert">Please install phpMyAdmin</p>
      </div>
    <?php
    else :
      $exists = true;
    ?>
      <!-- ANCHOR Lien vers phpMyAdmin  -->
      <div class="php-my-admin">
        <a class="php-my-admin__link" href="<?php echo $phpMyAdmin; ?>" target="_blank"><img src="https://i.imgur.com/kHv5dAy.png" alt="phpMyAdmin" height="18"> phpmyadmin</a>
      </div>
    <?php
    endif;
    ?>

  </main>
  <?php
  // 
  $dirList = glob('*', GLOB_ONLYDIR);
  usort($dirList, function ($a, $b) {
    return filemtime($b) - filemtime($a);
    var_dump(filemtime($b));
  });

  if ($dirList != NULL) :
  ?>
    <nav class="project">
      <ul class="project__ul">
        <!-- ANCHOR Liens vers les projets -->
        <?php
        foreach ($dirList as $key => $value) :
          $link = 'https://' . $value . '.dev';
        ?>
          <li class="project__li">
            <a class="project__link" href="<?php echo $link; ?>" target="_blank"><?php echo $link; ?> <i class="fas fa-external-link-alt"></i></a>
          </li>
        <?php
        endforeach;
        ?>
      </ul>
    </nav>
  <?php
  else :
  ?>
    <aside>
      <p class="alert">There are no directories, create your first project now</p>
      <div>
        <img src="https://i.imgur.com/3Sgu8XI.png" alt="Offline">
      </div>
    </aside>
  <?php
  endif;
  ?>
</body>

</html>
