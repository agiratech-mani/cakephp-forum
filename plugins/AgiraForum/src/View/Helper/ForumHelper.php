<?php 
namespace AgiraForum\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;

class ForumHelper extends Helper
{
    public function title()
    {
        // set meta description
    		(new View)->assign("title",'asda');
        echo "Test";
    }
}
?>