<?php

namespace InterExcludeCategory;

use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;
use Thelia\Module\BaseModule;

class InterExcludeCategory extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'interexcludecategory';

    /** @var string */
    const ROUTER = 'router.interexcludecategory';

    public function preActivation(ConnectionInterface $con = null)
    {
        if (!$this->getConfigValue('is_initialized', false)) {
            $database = new Database($con);

            $database->insertSql(null, array(__DIR__ . '/Config/thelia.sql'));

            $this->setConfigValue('is_initialized', true);
        }

        return true;
    }
}
