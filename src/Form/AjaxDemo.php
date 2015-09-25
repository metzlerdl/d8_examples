<?php

/**
 * @file
 * Contains Drupal\form_example\Form\SimpleForm.
 */

namespace Drupal\fapi_example\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the SimpleForm form controller.
 *
 * This class extends FormBase which is the simplest form base class used in
 * Drupal.
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
   * Build the simple form.
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
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

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
    $form_state->setRebuild();
    return $form['color_wrapper'];
  }

}
