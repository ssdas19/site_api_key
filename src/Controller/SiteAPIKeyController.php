<?php

namespace Drupal\site_api_key\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Node\NodeInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Site API Key Controller.
 */
class SiteAPIKeyController extends ControllerBase {
    
    /**
     * Returns a Node data in JSON format.
     */
    public function json_content(string $site_api_key, NodeInterface $node, Request $request) {

        $node_array = (array)$node;

        return new JsonResponse([ 'data' => $node_array]);
      }
}