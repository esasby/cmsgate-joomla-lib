<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikit
 * Date: 13.04.2020
 * Time: 12:23
 */

namespace esas\cmsgate;

use esas\cmsgate\lang\LocaleLoaderJoomla;

abstract class CmsConnectorJoomla extends CmsConnector
{
    public function createConfigStorage()
    {
        return new ConfigStorageJoomla();
    }

    public function createLocaleLoader()
    {
        return new LocaleLoaderJoomla();
    }
}