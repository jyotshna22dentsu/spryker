<?php
namespace Pyz\Yves\CustomerPage;

use SprykerShop\Yves\CustomerPage\CustomerPageFactory as BaseClass;
use Pyz\Yves\CustomerPage\Form\FormFactory;
use Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface;
use Pyz\Yves\CustomerPage\CustomerPageDependencyProvider;
class CustomerPageFactory extends BaseClass
{
  /**
     * @return \Pyz\Yves\CustomerPage\Form\FormFactory
     */
    public function createKidsFormFactory()
    {
        return new FormFactory();
    }
     /**
     * @return \Pyz\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface
     */
    public function getCustomerExtendedClient(): CustomerPageToCustomerClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER);
    }
}
?>