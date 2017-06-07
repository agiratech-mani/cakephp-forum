<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta(
        'favicon-transparent.png',
        '/favicon-transparent.png',
        ['type' => 'icon']
    );
    ?>  
    <title><?= (isset($title)?$title:$this->fetch('title')); ?></title>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('public.css') ?>
    <?= $this->Html->css('AgiraForum.editor'); ?>
    <?= $this->Html->css('common.css') ?>
    <?= $this->Html->css('AgiraForum.forum.css') ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?= $this->element('public-nav'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
             <?= $this->Flash->render() ?>
        </div>
         <?php
            $loguser = $this->request->session()->read('Auth.User');
        ?> 
        <?php if(!empty($loguser)): ?>
        <?php endif; ?>
        <div class="row">
            <?= $this->fetch('content') ?>
        </div>
    </div>
    <?= $this->element('public-footer'); ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('AgiraForum.jquery.form'); ?>
    <?= $this->Html->script('AgiraForum.editor'); ?>
    <?= $this->Html->script('AgiraForum.common'); ?>
</body>

</html>
