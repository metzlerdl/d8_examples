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
class DemoBase extends FormBase {

  /**
   * Build the simple form.
   *
   * A build form method constructs an array that defines how markup and
   * other form elements are included in an HTML form.
   *
   * @param array $form
   *   Default form array structure.
   * @param FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form.
    $form['actions'] = array(
      '#type' => 'actions',
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
   * The form ID is used in implementations of hook_form_alter() to allow other
   * modules to alter the render array built by this form controller.  it must
   * be unique site wide. It normally starts with the providing module's name.
   *
   * @return string
   *   The unique ID of the form defined by this class.
   */
  public function getFormId() {
    return 'fapi_example_demo_base';
  }

  /**
   * Implements form validation.
   *
   * The validateForm method is the default method called to validate input on
   * a form.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * Implements a form submit handler.
   *
   * The submitForm method is the default method called for any submit elements.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //Find out what was submitted
    $values = $form_state->getValues();
    foreach($values  as $key => $value) {
      $label = isset($form[$key]['#title']) ? $form[$key]['#title'] : $key;

      // many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) $value = array_filter($value);

      // Only display for controls that have titles and values.
      if ($value ) {
        $display_value = is_array($value) ? print_r($value, 1) : $value;
        $message = $this->t('Value for %title: %value' , array('%title' => $label, '%value' => $display_value));
        drupal_set_message($message);
      }
    }
  }

}
