<?php

namespace esas\cmsgate\joomla;

use esas\cmsgate\Registry;
use esas\cmsgate\utils\XMLUtils;
use Joomla\CMS\Form\Form;
use SimpleXMLElement;

class CmsgateConfigFormJoomla extends Form
{
    /**
     * @param SimpleXMLElement $data
     * @param bool $replace
     * @param bool $xpath
     */
    public function load($data, $replace = true, $xpath = false)
    {
        if ($this->name == Registry::getRegistry()->getModuleDescriptor()->getModuleMachineName()) {
            foreach (Registry::getRegistry()->getConfigFormsArray() as $configForm) {
                $fieldSetArray = $configForm->generate();
                XMLUtils::inject($data->vmconfig->fields, $fieldSetArray, $this->getInjectionPath());
            }
        }
        return parent::load($data, $replace, $xpath);
    }

    public function getInjectionPath() {
        return "config"; // <extension><config>...
    }
}