<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Dependency\Client;
use Generated\Shared\Transfer\KidsBirthdayTransfer;


interface CustomerPageToCustomerClientInterface  
{

     /**
     * @param \Generated\Shared\Transfer\KidsBirthdayTransfer $kidsBirthdayTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function createKidsBirthday(KidsBirthdayTransfer $kidsBirthdayTransfer);
}
