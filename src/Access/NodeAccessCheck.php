<?php

namespace Drupal\site_api_key\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Node\NodeInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Checks access for displaying configuration translation page.
 */
class NodeAccessCheck implements AccessInterface {

  /**
   * {@inheritdoc}
   */
  public function access() {

    $site_api_key = \Drupal::config('system.site')->get('siteapikey');

    $api_key = \Drupal::routeMatch()->getParameter('site_api_key');
    $node = \Drupal::routeMatch()->getParameter('node');

    if ($node->getType() == "page" && $site_api_key == $api_key) {
      return AccessResult::allowed();
    }
    else {
      return AccessResult::forbidden();
    }
  }

}