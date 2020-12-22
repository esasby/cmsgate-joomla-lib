<?php


namespace esas\cmsgate\joomla;


class InstallHelperJoomla
{
    public static function dbActivateExtension(){
        CmsgateModelJoomla::activateExtension();
    }
}