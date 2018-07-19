<?php

namespace Drupal\custom_api\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Provides controllers for page node json via HTTP requests.
 */
class ApiControl extends ControllerBase {

  /**
   * Return Json og page type node.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request.
   * @param string $apiKey
   *   Api key for webservice.
   * @param \Drupal\Core\Entity\EntityInterface $node
   *   Node entity object for request $node.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   A response as json of requested node object.
   */
  public function content(Request $request, $apiKey = NULL, EntityInterface $node = NULL) {
    if ($node->getType() != 'page') {
      throw new AccessDeniedHttpException('access denied.');
    }

    $config = \Drupal::config('system.site');

    if ($config->get('siteapikey') == 'No API Key yet' || $config->get('siteapikey') == '') {
      throw new BadRequestHttpException('API key is not set yet. please inform your site admin');
    }
    if ($config->get('siteapikey') != $apiKey) {
      throw new AccessDeniedHttpException('access denied.');
    }

    $serializer = \Drupal::service('serializer');
    $data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
    $response = new Response($data);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

}
