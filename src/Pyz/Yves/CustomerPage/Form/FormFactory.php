<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerShop\Yves\CustomerPage\CustomerPageDependencyProvider;
use SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToStoreClientInterface;
use Pyz\Yves\CustomerPage\Form\DataProvider\KidsBirthdayFormDataProvider;


/**
 * @method \SprykerShop\Yves\CustomerPage\CustomerPageConfig getConfig()
 */
class FormFactory extends AbstractFactory
{
    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory()
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY);
    }

    /**
     * @param array $formOptions
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getKidsBirthdayForm(array $formOptions = [])
    {
        return $this->getFormFactory()->create(KidsBirthdayForm::class, null, $formOptions);
    }
    /**
     * @return \SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface
     */
    public function getCustomerClient()
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER);
    }
     /**
     * @return \SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToStoreClientInterface
     */
    public function getStoreClient(): CustomerPageToStoreClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_STORE);
    }

    /**
     * @return \Pyz\Yves\CustomerPage\Form\DataProvider\KidsBirthdayFormDataProvider
     */
    public function createKidsBirthdayFormDataProvider()
    {
        return new KidsBirthdayFormDataProvider($this->getCustomerClient(), $this->getStoreClient());
    }

}
