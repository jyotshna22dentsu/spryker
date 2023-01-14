<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form\DataProvider;

use Generated\Shared\Transfer\KidsBirthdayTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Pyz\Yves\CustomerPage\Form\KidsBirthdayForm;
use SprykerShop\Yves\CustomerPage\Form\DataProvider\AbstractAddressFormDataProvider;

class KidsBirthdayFormDataProvider extends AbstractAddressFormDataProvider
{
    /**
     * @param int|null $idCustomerAddress
     *
     * @return array
     */
    public function getData($idCustomerAddress = null)
    {
        $customerTransfer = $this->customerClient->getCustomer();

        if ($idCustomerAddress === null) {
            return $this->getDefaultAddressData($customerTransfer);
        }

        $kidsBirthdayForm = $this->loadKidsBirthdayTransfer($customerTransfer, $idCustomerAddress);
        if ($kidsBirthdayForm !== null) {
            return $kidsBirthdayForm->modifiedToArray();
        }

        return [];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return [
            KidsBirthdayForm::OPTION_GENDER_CHOICES => ["Male","Female","Other"],
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\KidsBirthdayTransfer $kidsBirthdayTransfer
     * @param int|null $idKidsBirthday
     *
     * @return \Generated\Shared\Transfer\KidsBirthdayTransfer|null
     */
    protected function loadKidsBirthdayTransfer(CustomerTransfer $customerTransfer, $idCustomerAddress = null)
    {
        $kidsBirthdayTransfer = new KidsBirthdayTransfer();
        $kidsBirthdayTransfer
            ->setFkCustomer($customerTransfer->getIdCustomer());

        return $this->customerClient->getAddress($kidsBirthdayTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return array
     */
    protected function getDefaultAddressData(CustomerTransfer $customerTransfer)
    {
        return [
            KidsBirthdayForm::FIELD_DOB => $customerTransfer->getDateOfBirth(),
            KidsBirthdayForm::FIELD_GENDER => $customerTransfer->getGender(),
            KidsBirthdayForm::FIELD_NAME => $customerTransfer->getFirstName(),
        ];
    }
}
