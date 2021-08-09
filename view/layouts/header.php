<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="http://localhost/mvc/public/css/custom.css">

</head>
<body>
    <input type="hidden" id="url" value="<?= App::route('') ?>">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                
                <a class="navbar-brand" href="<?= App::route('task') ?>"> test
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                            <?php if ($auth): ?>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                <?= $auth->name; ?>
                                <?= ($auth->type == 1) ? 'Admin' : '' ?>
                          </a>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= App::route('task') ?>">Task List</a>
                            <a class="dropdown-item" href="<?= App::route('log-out') ?>">Log Out</a>
                          </div>
                        </li>
                        <?php else: ?>
                            <a class="dropdown-item" href="<?= App::route('login') ?>">Log in</a>
                            <a class="dropdown-item" href="<?= App::route('register') ?>">Register</a>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">


