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
    return [
      '#markup' => 'Welcome to a page.',
    ];
  }

}
