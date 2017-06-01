<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon-transparent.png" type="image/x-icon">
    <title>Blog Home - Start Bootstrap Template</title>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('public.css') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="homepage">
    <!-- Navigation -->
    <?= $this->element('public-nav'); ?>

    <!-- Page Content -->
    <div class="container-fluid" id="homecontent">
        
        <div class="row">
            <?= $this->fetch('content') ?>
        </div>
    </div>
    <?= $this->element('public-footer'); ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
</body>

</html>
