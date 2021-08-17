<?php

namespace Drupal\welcome_module\Controller;

/**
 * Controller routing for the welcome page.
 */
class WelcomeController {

  /**
   * Callback for the route.
   */
  public function welcome() {
    $renderer     = \Drupal::service('renderer');
    $config       = \Drupal::config('system.site');
    $current_user = \Drupal::currentUser();
    $build        = [
      '#markup' => t('Hi, %name, Welcome to @site.',
        [
          '%name' => $current_user->getAccountName(),
          '@site' => $config->get('name'),
        ]),
      '#cache'  => [
        'contexts' => [
          'user',
        ],
      ],
    ];
    $renderer->addCacheableDependency($build, $config);
    $renderer->addCacheableDependency($build, \Drupal\user\Entity\User::load($current_user->id()));
    return $build;
  }

}
