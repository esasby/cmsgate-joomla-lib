<?php


namespace esas\cmsgate\joomla;


use JFile;
use JFolder;
use Joomla\CMS\Language\Text;

class InstallHelperJoomla
{
    public static function dbActivateExtension(){
        CmsgateModelJoomla::activateExtension();
    }

    public static function deleteWithLogging($file)
    {
        $deleted = true;
        if (is_dir($file)) {
            JFolder::delete($file);
            $deleted = !JFolder::exists($file);
        } elseif (is_file($file)) {
            $deleted = JFile::delete($file);
        }
        if (!$deleted) {
            echo Text::sprintf('JLIB_INSTALLER_ERROR_FILE_FOLDER', $file) . '<br />';;
        }
        return $deleted;
    }

}