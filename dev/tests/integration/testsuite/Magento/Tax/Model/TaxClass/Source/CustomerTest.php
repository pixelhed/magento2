<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Tax\Model\TaxClass\Source;

use Magento\TestFramework\Helper\Bootstrap;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetAllOptions()
    {
        /** @var \Magento\Tax\Model\Resource\TaxClass\Collection $collection */
        $collection = Bootstrap::getObjectManager()->get('Magento\Tax\Model\Resource\TaxClass\Collection');
        $expectedResult = [];
        /** @var \Magento\Tax\Model\ClassModel $taxClass */
        foreach ($collection as $taxClass) {
            if ($taxClass->getClassType() == \Magento\Tax\Api\TaxClassManagementInterface::TYPE_CUSTOMER) {
                $expectedResult[] = ['value' => $taxClass->getId(), 'label' => $taxClass->getClassName()];
            }
        }
        if (empty($expectedResult)) {
            $this->fail('Preconditions failed: At least one tax class should be available.');
        }
        /** @var \Magento\Tax\Model\TaxClass\Source\Product $source */
        $source = Bootstrap::getObjectManager()->get('Magento\Tax\Model\TaxClass\Source\Customer');
        $this->assertEquals(
            $expectedResult,
            $source->getAllOptions(),
            'Tax Class options are invalid.'
        );
    }

    public function testGetAllOptionsWithDefaultValues()
    {
        /** @var \Magento\Tax\Model\Resource\TaxClass\Collection $collection */
        $collection = Bootstrap::getObjectManager()->get('Magento\Tax\Model\Resource\TaxClass\Collection');
        $expectedResult = [];
        /** @var \Magento\Tax\Model\ClassModel $taxClass */
        foreach ($collection as $taxClass) {
            if ($taxClass->getClassType() == \Magento\Tax\Api\TaxClassManagementInterface::TYPE_CUSTOMER) {
                $expectedResult[] = ['value' => $taxClass->getId(), 'label' => $taxClass->getClassName()];
            }
        }
        if (empty($expectedResult)) {
            $this->fail('Preconditions failed: At least one tax class should be available.');
        }
        $expectedResult = array_merge([['value' => '0', 'label' => __('None')]], $expectedResult);
        /** @var \Magento\Tax\Model\TaxClass\Source\Product $source */
        $source = Bootstrap::getObjectManager()->get('Magento\Tax\Model\TaxClass\Source\Customer');
        $this->assertEquals(
            $expectedResult,
            $source->getAllOptions(true),
            'Tax Class options are invalid.'
        );
    }
}
