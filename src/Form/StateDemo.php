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
class StateDemo extends DemoBase {

  /**
   * Build the simple form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['needs_accommodation'] = array(
      '#type' => 'checkbox',
      '#title' => 'Need Special Accommodations?',
    );

    $form['accommodation'] = array(
     '#type' => 'container',
     '#attributes' => array(
       'class' => 'accommodation',
     ),
     '#states' => array(
       'invisible' => array(
         'input[name="needs_accommodation"]' => array('checked' => FALSE),
       ),
     ),
   );

   $form['accommodation']['diet'] = array(
     '#type' => 'textfield',
     '#title' => t('Dietary Restrictions'),
   );

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

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
   * Build the form.
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
