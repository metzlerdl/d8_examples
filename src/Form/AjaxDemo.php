<?php

/**
 * @file
 * Contains Drupal\fapi_example\Form\AjaxDemo.
 */

namespace Drupal\fapi_example\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the ajax demo form controller.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class AjaxDemo extends DemoBase {

  private $colors = [
    'warm' => [
      'red' => 'Red',
      'orange' => 'Orange',
      'yellow' => 'Yellow',
    ],
    'cool' => [
      'blue' => 'Blue',
      'purple' => 'Purple',
      'green' => 'Green',
    ],
  ];

  /**
   * Build the AJAX demo form.
   *
   * The #ajax attribute used in the temperature input element defines an ajax
   * callback that will invoke the colorCallback method on this form object.
   * Whenever the temperature element changes, it will invoke this callback and
   * replace the contents of the color_wrapper container with the reults of this
   * method call.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['temperature'] = [
      '#title' => $this->t('Temperature'),
      '#type' => 'select',
      '#options' => [ 'warm' => 'Warm', 'cool' => 'Cool'],
      '#empty_option' => $this->t('-select'),
      '#ajax' => [
        // Could also use [ $this, 'colorCallback']
        'callback' => '::colorCallback',
        'wrapper' => 'color-wrapper',
      ]
    ];
    $form_state->setCached(FALSE);

    $form['actions'] =[
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    //
    $form['color_wrapper'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'color-wrapper']
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'fapi_example_ajax_demo';
  }

  /**
   * Callback for Ajax event on color selection.
   */
  public function colorCallback(array &$form, FormStateInterface $form_state) {
    $temperature = $form_state->getValue('temperature');

    $form['color_wrapper']['color'] = [
      '#type' => 'select',
      '#title' => $this->t('Color'),
      '#options' => $this->colors[$temperature],
    ];

    return $form['color_wrapper'];
  }

}
