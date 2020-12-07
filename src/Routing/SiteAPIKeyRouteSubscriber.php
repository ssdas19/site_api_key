<?php
 
namespace Drupal\site_api_key\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
 
/**
 * {@inheritdoc}
 */
class SiteAPIKeyRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {

    if ($route = $collection->get('system.site_information_settings')) {
      $route->setDefault('_form', 'Drupal\site_api_key\Form\SiteAPIKeySiteInformationForm');
    }
  }
}