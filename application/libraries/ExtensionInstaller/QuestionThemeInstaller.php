<?php

namespace LimeSurvey\ExtensionInstaller;

/**
 */
class QuestionThemeInstaller extends ExtensionInstaller
{
    /**
     * @return SimpleXMLElement
     * @todo Move to parent class?
     */
    public function getConfig()
    {
        if ($this->fileFetcher) {
            return $this->fileFetcher->getConfig();
        } else {
            return null;
        }
    }

    /**
     * @return void
     */
    public function install()
    {
        $config = $this->getConfig();
    }

    public function update()
    {
        throw new Exception('Not implemented');
    }

    /**
     * @todo
     */
    public function uninstall()
    {
        throw new \Exception('Not implemented');
    }
}