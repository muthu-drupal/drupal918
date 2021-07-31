<?php

namespace Drupal\welcome_module\Form;

use Drupal\Core\Form\Formbase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class hello form.
 */
class HelloForm extends Formbase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'welcome_module_hello_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['descripption'] = [
      '#type'   => 'item',
      '#markup' => $this->t('Please enter the title and accept the terms of use of the site.'),
    ];

    $form['title'] = [
      '#type'        => 'textfield',
      '#title'       => 'Title',
      '#description' => ('Enter the title of the book. Title must be at least 10 chars length.'),
      '#required'    => TRUE,
    ];

    $form['accept'] = [
      '#type'        => 'checkbox',
      '#title'       => $this->t('I accept the terms of use of the site'),
      '#description' => $this->t('Please read the terms and condition'),
    ];

    $form['needs_accommodation'] = [
      '#type'  => 'checkbox',
      '#title' => $this
        ->t('Need Special Accommodations?'),
    ];
    $form['accommodation'] = [
      '#type'       => 'container',
      '#attributes' => [
        'class' => 'accommodation',
      ],
      '#states'     => [
        'invisible' => [
          'input[name="needs_accommodation"]' => [
            'checked' => FALSE,
          ],
        ],
      ],
    ];
    $form['accommodation']['diet'] = [
      '#type'  => 'textfield',
      '#title' => $this
        ->t('Dietary Restrictions'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $title  = $form_state->getValue('title');
    $accept = $form_state->getValue('accept');

    if (strlen($title) < 10) {
      $form_state->setErrorByName('title', $this->t('The title must be atleast 10 characters.'));
    }

    if (empty($accept)) {
      $form_state->setErrorByName('accept', $this->t('You must accept the terms of use to continue.'));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Call the static container service.
    $messenger = \Drupal::messenger();
    $messenger->addMessage('Title: ' . $form_state->getValue('title'));
    $messenger->addMessage('Accept: ' . $form_state->getValue('accept'));

    // Redirect to home page.
    $form_state->setRedirect('<front>');

  }

}
