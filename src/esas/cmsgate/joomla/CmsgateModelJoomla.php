<?php


namespace esas\cmsgate\joomla;

use esas\cmsgate\Registry;
use Exception;
use JDatabaseQuery;
use \JFactory;
use \JModelLegacy;

class CmsgateModelJoomla extends JModelLegacy
{
    /**
     * JPluginHelper::getPlugin не используется, т.к. в нем доступны только плагины со статусом enabled
     * @param $extensionType
     * @param $extensionName
     * @return |null
     */
    public static function getExtensionId($extensionType = null, $extensionName = null)
    {
        if ($extensionType == null) $extensionType = Registry::getRegistry()->getModuleDescriptor()->getModuleType();
        if ($extensionName == null) $extensionName = Registry::getRegistry()->getModuleDescriptor()->getModuleMachineName();
        $db = JFactory::getDBO();
        /** @var JDatabaseQuery $query */
        $query = $db->getQuery(true);
        $query
            ->select("extension_id")
            ->from('#__extensions')
            ->where('type = ' . $db->quote($extensionType))
            ->where('element = ' . $db->quote($extensionName));
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if (count($rows) != 1) {
            return null;
        }
        return $rows[0]->extension_id;
    }

    public static function activateExtension($extensionType = null, $extensionName = null)
    {
        if ($extensionType == null) $extensionType = Registry::getRegistry()->getModuleDescriptor()->getModuleType();
        if ($extensionName == null) $extensionName = Registry::getRegistry()->getModuleDescriptor()->getModuleMachineName();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->update('#__extensions')
            ->set($db->quoteName('enabled') . ' = 1')
            ->where('type = ' . $db->quote($extensionType))
            ->where('element = ' . $db->quote($extensionName));
        $db->setQuery($query);
        if (!$db->execute())
            throw new Exception('Can not activate plugin');
    }

    /**
     * @param string $tableName
     * @return bool
     */
    public static function isTableExists($tableName)
    {
        $db = JFactory::getDBO();
        $query = 'SHOW TABLES LIKE "%' . str_replace('#__', $db->getPrefix(), $tableName) . '"';
        $db->setQuery($query);
        $result = $db->loadResult();
        return !empty($result);
    }
}