<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'AgiraForum',
    ['path' => '/forum'],
    function (RouteBuilder $routes) {
    		$routes->connect('/', ['controller' => 'ForumForums', 'action' =>'index' ]);
    		$routes->connect('/posts', ['controller' => 'ForumForums', 'action' =>'index' ]);
            $routes->connect('/posts/like/*', ['controller' => 'ForumPostLikes', 'action' =>'like']);
    		$routes->connect('/posts/:action/*', ['controller' => 'ForumForums']);

			$routes->connect('/profile/forums', ['controller' => 'ForumForums', 'action' =>'userForums']);
            $routes->connect('/profile/posts', ['controller' => 'ForumPosts', 'action' =>'userPosts']);
			
        $routes->fallbacks(DashedRoute::class);
    }
);
Router::prefix('admin', function ($routes) {
    $routes->plugin('AgiraForum', ['path' => '/forum'], function (RouteBuilder $routes) {
    		$routes->connect('/categories', ['controller' => 'ForumCategories', 'action' =>'index' ]);
    		$routes->connect('/categories/:action/*', ['controller' => 'ForumCategories']);

    		$routes->connect('/topics', ['controller' => 'ForumTopics', 'action' =>'index' ]);
    		$routes->connect('/topics/:action/*', ['controller' => 'ForumTopics']);

    		$routes->connect('/tags', ['controller' => 'ForumTags', 'action' =>'index' ]);
    		$routes->connect('/tags/:action/*', ['controller' => 'ForumTags']);

			$routes->connect('/posts', ['controller' => 'ForumForums', 'action' =>'index' ]);
    		$routes->connect('/posts/:action/*', ['controller' => 'ForumForums']);

			$routes->connect('/contents', ['controller' => 'ForumPosts', 'action' =>'index' ]);
    		$routes->connect('/contents/:action/*', ['controller' => 'ForumPosts']);

    		$routes->fallbacks(DashedRoute::class);
    });
});