<?php 
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;

class CommonHelper extends Helper
{
	  public $helpers = array('Time');

    public function date($date)
    {
        // set meta description
    		return $this->Time->format(
                $date,
                "MMMM dd, yyyy HH:mm"
        );
    }
}
?>