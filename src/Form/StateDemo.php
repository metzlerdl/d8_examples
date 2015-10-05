<?php

/**
 * @file
 * Contains Drupal\fapi_example\Form\StateDemo.
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
class StateDemo extends DemoBase {

  /**
   * Build the simple form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['needs_accommodation'] = [
      '#type' => 'checkbox',
      '#title' => 'Need Special Accommodations?',
    ];

    $form['accommodation'] = [
     '#type' => 'container',
     '#attributes' => [
       'class' => 'accommodation',
     ],
     '#states' => [
       'invisible' => [
         'input[name="needs_accommodation"]' => array('checked' => FALSE),
       ],
     ],
   ];

   $form['accommodation']['diet'] = [
     '#type' => 'textfield',
     '#title' => t('Dietary Restrictions'),
   ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'fapi_example_state_demo';
  }

  /**
   * Implements submitForm callback.
   *
   * @inheritdoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //Find out what was submitted
    $values = $form_state->getValues();
    if ($values['needs_accomodation']) {
      drupal_set_message($this->t('Dietary Restriction Requested: %diet'), array('%diet' => $values['diet']));
    }
  }


}
