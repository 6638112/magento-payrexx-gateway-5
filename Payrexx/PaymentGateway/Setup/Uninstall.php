<?php
/**
 * Payrexx Payment Gateway
 *
 * Copyright © 2018 PAYREXX AG (https://www.payrexx.com)
 * See LICENSE.txt for license details.
 *
 * @author SoftSolutions4U <info@softsolutions4u.com>
 */
namespace Payrexx\PaymentGateway\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

/**
 * Remove the data during module uninstall
 */
class Uninstall implements UninstallInterface
{
    /**
     * Remove data that was created during module installation.
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function uninstall(
        SchemaSetupInterface   $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        // Remove config values
        $configTable = $setup->getTable('core_config_data');
        $setup->getConnection()->delete(
            $configTable,
            "`path` LIKE 'payment/payrexx_payment/%'"
        );
        $setup->endSetup();
    }
}