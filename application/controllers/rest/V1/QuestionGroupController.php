<?php

/*
* LimeSurvey
* Copyright (C) 2007-2011 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

use LimeSurvey\Api\Command\Request\Request;
use LimeSurvey\Api\Command\V1\QuestionGroupList;
use LimeSurvey\Api\Command\V1\QuestionGroupPropertiesGet;
use LimeSurvey\Api\Command\V1\QuestionGroupPropertiesSet;
use LimeSurvey\Api\Command\V1\QuestionGroupDelete;

class QuestionGroupController extends LSYii_ControllerRest
{
    /** 
     * Get array of question groups or one specific question group.
     * 
     * @param string $id Question Group Id
     * @return void
     */
    public function actionIndexGet($id = null)
    {
        if ($id == null) {
            $request = Yii::app()->request;
            $requestData = [
                'sessionKey' => $this->getAuthToken(),
                'surveyID' => $request->getParam('surveyId'),
                'language' => $request->getParam('language')
            ];
            $commandResponse = (new QuestionGroupList)
                ->run(new Request($requestData));

            $this->renderCommandResponse($commandResponse);
        } else {
            $request = Yii::app()->request;
            $requestData = [
                'sessionKey' => $this->getAuthToken(),
                'groupID' => $id,
                'groupSettings' => $request->getParam('groupSettings'),
                'language' => $request->getParam('language')
            ];
            $commandResponse = (new QuestionGroupPropertiesGet)
                ->run(new Request($requestData));

            $this->renderCommandResponse($commandResponse);
        }
    }

    /** 
     * Update question group properties.
     * 
     * @param string $id Question Group Id
     * @return void
     */
    public function actionIndexPut($id)
    {
        $request = Yii::app()->request;
        $data    = $request->getRestParams();

        $requestData = [
            'sessionKey' => $this->getAuthToken(),
            'groupID' => $id,
            'language' => isset($data['language']) ? $data['language'] : '',
            'questiongroupl10ns' => isset($data['questiongroupl10ns']) ? $data['questiongroupl10ns'] : '',
            'group_order' => isset($data['group_order']) ? $data['group_order'] : '',
            'grelevance' => isset($data['grelevance']) ? $data['grelevance'] : '',
        ];
        $commandResponse = (new QuestionGroupPropertiesSet)
            ->run(new Request($requestData));

        $this->renderCommandResponse($commandResponse);
    }

    /** 
     * Delete question groups by question group id.
     * 
     * @param string $id Question Group Id 
     * @return void
     */
    public function actionIndexDelete($id)
    {
        $requestData = [
            'sessionKey' => $this->getAuthToken(),
            'groupID' => $id
        ];
        $commandResponse = (new QuestionGroupDelete)
            ->run(new Request($requestData));

        $this->renderCommandResponse($commandResponse);
    }
}
