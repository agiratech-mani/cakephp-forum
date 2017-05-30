<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forum Admin:<?= $this->fetch('title') ?></title>

    <!-- Bootstrap Core CSS -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('sb-admin.css') ?>
    <?= $this->Html->css('plugins/morris.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Forum Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <?php
                        $loguser = $this->request->session()->read('Auth.User');
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $loguser['username'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link('<i class="fa fa-fw fa-user"></i> '.__('Profile'), ['controller' => 'Users', 'action' => 'edit',$loguser['id']],['escape' => false]) ?>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?= $this->Html->link('<i class="fa fa-fw fa-power-off"></i> '.__('Log Out'), ['controller' => 'Users', 'action' => 'logout','prefix'=>false],['escape' => false]) ?>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-fw fa-users"></i> '.__('Users'), ['controller' => 'Users', 'action' => 'index'],['escape' => false]) ?>
                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" class="container">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?= $this->fetch('title') ?>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                 <div class="row">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('plugins/morris/raphael.min.js') ?>
    <?= $this->Html->script('plugins/morris/morris.min.js') ?>
    <?= $this->Html->script('plugins/morris/morris-data.js') ?>

</body>

</html>
