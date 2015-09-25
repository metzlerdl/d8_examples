<?php

/**
 * @file
 * Contains Drupal\form_example\Form\SimpleForm.
 *
 * Sample form for demoing the order of the form process.
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
class BuildDemo extends FormBase {

  public function __construct() {
    static $i=0;
    $i++;
    drupal_set_message("Constructor $i");
  }

  /**
   * Build the simple form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    static $i = 0;
    $i++;
    drupal_set_message("buildForm $i");

    $form['chnage'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Change Me'),
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'message-wrapper',
      ],
    ];
    $form['actions'] = array(
      '#type' => 'actions',
    );

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Submit',
    );


    // Add button handlers.
    $form['actions']['button'] = array(
      '#type' => 'button',
      '#value' => 'Rebuild',
    );

    $form['actions']['rebuild'] = array(
      '#type' => 'button',
      '#value' => 'Submit Rebuild',
      '#submit' => ['::rebuildFormSubmit']
    );

    $form['actions']['ajaxsubmit'] = array(
      '#type' => 'submit',
      '#value' => 'Ajax Submit',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'message-wrapper',
      ]
    );

    $form['messages'] = array(
      '#type' => 'container',
      '#attributes' => ['id' => 'message-wrapper']
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
    static $i = 0;
    $i++;
    drupal_set_message("getFormId $i");
    return 'fapi_example_simple_form';
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
    static $i = 0;
    $i++;
    drupal_set_message("validateForm $i");
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
    static $i = 0;
    $i++;
    drupal_set_message("submitForm $i");
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * Demonstrates ajax button submit.
   */
  public function ajaxSubmit(array &$form, FormStateInterface $form_state) {
    static $i = 0;
    $i++;
    drupal_set_message("ajaxSubmit $i");
    $form['messages']['status'] = [
      '#type' => 'status_messages',
    ];

    return $form['messages'];
  }

  /**
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * Test a submit that causes form state rebuild
   */
  public function rebuildFormSubmit(array &$form, FormStateInterface $form_state) {
    static $i = 0;
    $i++;
    drupal_set_message("rebuildFormSubmit $i");
    $form_state->setRebuild(TRUE);
  }

}
