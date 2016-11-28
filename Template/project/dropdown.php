    <li>
       <i class="fa fa-th-large fa-fw"></i>&nbsp;
        <?= $this->url->link(t('View all boards'), 'AllBoardViewHTMLController', 'projectAll', array('plugin' => 'allBoardViewHTML', 'project_id' => $project['id'])) ?>
    </li>
