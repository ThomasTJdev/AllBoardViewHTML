<?php

namespace Kanboard\Plugin\AllBoardViewHTML\Controller;

use Kanboard\Controller\BaseController;
use Kanboard\Controller\TaskModificationController;

class AllBoardViewHTMLController extends BaseController
{
    public function project()
    {
	$project = $this->getProject();

	$AllBoardViewHTMLData = $this->allBoardViewHTMLModel->AllBoardViewHTMLFullTasksList($project['id']);

        $this->response->html($this->helper->layout->app('allBoardViewHTML:allboardviewhtml/show', array('title' => t('AllBoardViewHTML'),
            'project' => $project,
	    'AllBoardViewHTMLData' => $AllBoardViewHTMLData
        )));
    }

    public function projectAll()
    {
	//$project = $this->getProject();
	$user = $this->getUser();

	$projectAccess = $this->allBoardViewHTMLModel->AllBoardViewHTMLGetProjectid($user['id']);
	$AllBoardViewHTMLData = $this->allBoardViewHTMLModel->allBoardViewHTMLFullTasksListAll($projectAccess);
    $AllBoardViewHTMLDataST = $this->allBoardViewHTMLModel->allBoardViewHTMLFullSubtasksListAll($projectAccess);

        $this->response->html($this->helper->layout->app('allBoardViewHTML:allboardviewhtml/show', array('title' => t('AllBoardViewHTML - All projects'),
            'project' => 'Allprojects',
	    'AllBoardViewHTMLData' => $AllBoardViewHTMLData,
        'AllBoardViewHTMLDataST' => $AllBoardViewHTMLDataST
        )));
    }

}
