<?php

namespace esas\cmsgate;


use Exception;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\Registry\Registry as  JRegistry;

class ConfigStorageJoomla extends ConfigStorageCms
{
    private $configuration;

    /**
     * ConfigurationWrapperOpencart constructor.
     * @param $config
     */
    public function __construct()
    {
        parent::__construct();
        $plugin = PluginHelper::getPlugin(Registry::getRegistry()->getModuleDescriptor()->getModuleType(), Registry::getRegistry()->getModuleDescriptor()->getModuleMachineName());
        $this->configuration = new JRegistry($plugin->params);
    }

    /**
     * @param $key
     * @return string
     * @throws Exception
     */
    public function getConfig($key)
    {
       return $this->configuration->get($key);
    }

    /**
     * @param $cmsConfigValue
     * @return bool
     * @throws Exception
     */
    public function convertToBoolean($cmsConfigValue)
    {
        return strtolower($cmsConfigValue) == '1' || strtolower($cmsConfigValue) == 'y' || strtolower($cmsConfigValue) == 'yes';
    }

    public function createCmsRelatedKey($key)
    {
        return $key;
    }

    /**
     * Сохранение значения свойства в харнилища настроек конкретной CMS.
     *
     * @param string $key
     * @throws Exception
     */
    public function saveConfig($key, $value)
    {
        //not implemented
    }
}