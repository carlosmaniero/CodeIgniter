<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-responsive.min.css') ?>">

        <script src="<?= base_url('assets/js/vendor/modernizr-2.6.2.min.js') ?>"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">

            <!-- Flash messages -->
            <?php if($success = $this->session->flashdata('success')): ?>
                <p class="text-success"><?= $success; ?></p>
            <?php endif; ?>

            <?php if($info = $this->session->flashdata('info')): ?>
                <p class="text-info"><?= $info; ?></p>
            <?php endif; ?>

            <?php if($warning = $this->session->flashdata('warning')): ?>
                <p class="text-warning"><?= $warning; ?></p>
            <?php endif; ?>

            <?php if($error = $this->session->flashdata('error')): ?>
                <p class="text-error"><?= $error; ?></p>
            <?php endif; ?>
            <!-- End Flash messages -->

            <?= $contents ?>

        </div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>

        <script>window.jQuery || document.write('<script src="<?= base_url('assets/js/vendor/jquery-1.9.1.min.js')?>"><\/script>')</script>
        <script src="<?= base_url('assets/js/plugins.js') ?>"></script>
        <script src="<?= base_url('assets/js/vendor/bootstrap.min.js')?>"></script>
        <script src="<?= base_url('assets/js/vendor/bootbox.min.js')?>"></script>
        <script src="<?= base_url('assets/js/vendor/jquery.maskedinput.min.js')?>"></script>

        <!-- Coffeescript fles -->
        <script src="<?= base_url('assets/coffee/controller.js')?>"></script>
        <script src="<?= base_url('assets/coffee/scaffold.js')?>"></script>
        <script src="<?= base_url('assets/coffee/posts.js')?>"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
