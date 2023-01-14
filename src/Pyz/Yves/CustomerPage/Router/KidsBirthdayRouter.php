<?php
namespace Pyz\Yves\CustomerPage\Router;
use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;
class KidsBirthdayRouter extends AbstractRouteProviderPlugin{
    protected const ROUTE_KIDS_BIRTHDAY = 'customer/kids-birthday';
    protected const ROUTE_KIDS_BIRTHDAY_CREATE = 'customer/kids-birthday/create';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addCustomerKidsBirthDayRoute($routeCollection);
        $routeCollection = $this->addCustomerKidsBirthDayCreateRoute($routeCollection);
        return $routeCollection;
    }
     /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCustomerKidsBirthDayRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/customer/kids-birthday', 'CustomerPage', 'KidsBirthDay', 'indexAction');
        $routeCollection->add(static::ROUTE_KIDS_BIRTHDAY, $route);

        return $routeCollection;
    }
     /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCustomerKidsBirthDayCreateRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/customer/kids-birthday/create', 'CustomerPage', 'KidsBirthDay', 'createAction');
        $routeCollection->add(static::ROUTE_KIDS_BIRTHDAY_CREATE, $route);

        return $routeCollection;
    }
}
?>