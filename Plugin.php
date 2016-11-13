<?php

namespace Kanboard\Plugin\AllBoardViewHTML;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
	// WARNING !! This is changing the security policy
	$this->setContentSecurityPolicy(array('default-src' => '* \'unsafe-inline\' \'unsafe-eval\''));

	$this->template->hook->attach('template:dashboard:sidebar', 'allBoardViewHTML:dashboard/dashboardsidebar');
	$this->template->hook->attach('template:project:dropdown', 'allBoardViewHTML:project/dropdown');
	$this->template->hook->attach('template:project:sidebar', 'allBoardViewHTML:project/sidebar');

    }

    public function getClasses()
    {
        return array(
            'Plugin\AllBoardViewHTML\Model' => array(
		'AllBoardViewHTMLModel'
             )
         );
    }

    public function getPluginName()
    {
        return 'AllBoardViewHTML';
    }
    public function getPluginAuthor()
    {
        return 'TTJ';
    }
    public function getPluginVersion()
    {
        return '0.0.1';
    }
    public function getPluginDescription()
    {
        return 'AllBoardViewHTML';
    }
    public function getPluginHomepage()
    {
        return '';
    }
}
