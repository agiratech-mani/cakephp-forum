<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Agira Forum</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse  navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $loguser = $this->request->session()->read('Auth.User');
                    ?> 
                    <?php if(empty($loguser)): ?>
                     <li>
                        <?= $this->Html->link(__('Forum'), ['controller' => 'ForumForums', 'action' => 'index','prefix'=>false,'plugin'=>'AgiraForum'],['escape' => false]) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-fw fa-user"></i> '.__('Sign Up'), ['controller' => 'Users', 'action' => 'register','prefix'=>false,'plugin'=>false],['escape' => false]) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('<i class="fa fa-fw fa-sign-in"></i> '.__('Log In'), ['controller' => 'Users', 'action' => 'login','prefix'=>false,'plugin'=>false],['escape' => false]) ?>
                    </li>
                   
                    <?php else: ?>
                    <?php if($authUser['role'] == 'admin'){ ?>
                    <li>
                        <?= $this->Html->link(__('Admin Panel'), ['controller' => 'Users', 'action' => 'index','prefix'=>'admin','plugin'=>false],['escape' => false]) ?>
                    </li>
                    <?php } else if($authUser['role'] == 'moderator'){  ?>
                     <li>
                        <?= $this->Html->link(__('Admin Panel'), ['controller' 
                        => 'ForumForums', 'action' => 'index','prefix'=>'admin','plugin'=>false],['escape' => false]) ?>
                    </li>
                    <?php } ?>
                    <li>
                        <?= $this->Html->link(__('Forum'), ['controller' => 'ForumForums', 'action' => 'index','prefix'=>false,'plugin'=>'AgiraForum'],['escape' => false]) ?>
                    </li>
                    <li>
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $loguser['username'] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <?= $this->Html->link(__('Profile'), ['controller' => 'Users', 'action' => 'edit',$loguser['id'],'plugin'=>false],['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Forums'), ['controller' => 'ForumForums', 'action' => 'userForums','plugin'=>"AgiraForum"],['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Posts'), ['controller' => 'ForumPosts', 'action' => 'userPosts','plugin'=>"AgiraForum"],['escape' => false]) ?>
                            </li>
                             <li>
                                <?= $this->Html->link(__('Change Password'), ['controller' => 'Users', 'action' => 'change_password',$loguser['id'],'plugin'=>false],['escape' => false]) ?>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?= $this->Html->link('<i class="fa fa-fw fa-sign-out"></i> '.__('Log Out'), ['controller' => 'Users', 'action' => 'logout','prefix'=>false,'plugin'=>false],['escape' => false]) ?>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
        </div>
        <!-- /.container -->
    </nav>