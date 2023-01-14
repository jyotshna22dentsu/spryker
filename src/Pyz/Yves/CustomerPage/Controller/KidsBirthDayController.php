<?php
namespace Pyz\Yves\CustomerPage\Controller;

use SprykerShop\Yves\CustomerPage\Controller\CustomerController;
use SprykerShop\Yves\CustomerPage\Plugin\Router\CustomerPageRouteProviderPlugin;
use Symfony\Component\HttpFoundation\Request;
use Spryker\Shared\Customer\Code\Messages;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\KidsBirthdayTransfer;
/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class KidsBirthDayController extends CustomerController
{
    public function indexAction()
    {
        $response = $this->executeIndexAction();

        if (!is_array($response)) {
            return $response;
        }
        return $this->view(
            $response,
            $this->getFactory()->getCustomerOverviewWidgetPlugins(),
            '@CustomerPage/views/kids-birthday/kids-birthday.twig',
        );
    }
    protected function executeIndexAction()
    {
        $loggedInCustomerTransfer = $this->getLoggedInCustomerTransfer();

        if (!$loggedInCustomerTransfer->getIdCustomer()) {
            return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_NAME_LOGOUT);
        }

        // $orderListTransfer = $this->createOrderListTransfer($loggedInCustomerTransfer);
        // $orderList = $this->getFactory()->getSalesClient()->getPaginatedCustomerOrdersOverview($orderListTransfer);
        // $aggregatedDisplayNames = $this->getFactory()->createItemStateMapper()->aggregateItemStatesDisplayNamesByOrderReference($orderList->getOrders());

        return [
            'customer' => $loggedInCustomerTransfer,
            // 'orderList' => $orderList->getOrders(),
            // 'ordersAggregatedItemStateDisplayNames' => $aggregatedDisplayNames,
            // 'addresses' => $this->getDefaultAddresses($loggedInCustomerTransfer),
        ];
    }
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $response = $this->executeCreateAction($request);

        if (!is_array($response)) {
            return $response;
        }

        return $this->view($response, [], '@CustomerPage/views/kids-birthday/create-kids-birthday.twig');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    protected function executeCreateAction(Request $request)
    {
         $customerTransfer = $this->getLoggedInCustomerTransfer();

        $dataProvider = $this
            ->getFactory()
            ->createKidsFormFactory()
            ->createKidsBirthdayFormDataProvider();
        $kidsBirthdayForm = $this
            ->getFactory()
            ->createKidsFormFactory()
            ->getKidsBirthdayForm($dataProvider->getOptions())
            ->handleRequest($request);

        if ($kidsBirthdayForm->isSubmitted() === false) {
            $kidsBirthdayForm->setData($dataProvider->getData());
        }

        if ($kidsBirthdayForm->isSubmitted() && $kidsBirthdayForm->isValid()) {
            $this->createKidsBirthday($customerTransfer, $kidsBirthdayForm->getData());

            $this->addSuccessMessage(Messages::CUSTOMER_ADDRESS_ADDED);

            return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_NAME_CUSTOMER_ADDRESS);
        }

        return [
            'form' => $kidsBirthdayForm->createView(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param array $addressData
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createKidsBirthday(CustomerTransfer $customerTransfer, array $kidsBirthdayData)
    {
        $kidsBirthdayTransfer = new KidsBirthdayTransfer();
        $kidsBirthdayTransfer->fromArray($kidsBirthdayData);
        $kidsBirthdayTransfer
            ->setFkCustomer($customerTransfer->getIdCustomer());

        $customerTransfer = $this
            ->getFactory()
            ->getCustomerExtendedClient()
            ->createKidsBirthday($kidsBirthdayTransfer);

        return $customerTransfer;
    }
    

}
?>