<?php

namespace esas\cmsgate\lang;


use Joomla\CMS\Factory;

class LocaleLoaderJoomla extends LocaleLoaderCms
{
    public function getLocale()
    {
        $cmsLocale = Factory::getLanguage()->getTag();
        return str_replace("-", "_", $cmsLocale);
    }


    public function getCmsVocabularyDir()
    {
        return dirname(__FILE__);
    }
}