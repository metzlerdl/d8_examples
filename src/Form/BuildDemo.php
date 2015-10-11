<?php

/**
 * @file
 * Contains Drupal\fapi_example\Form\BuildDemo.
 */

namespace Drupal\fapi_example\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements the build demo form controller.
 *
 * The form uses drupal_set_message() calls to demonstrate the order of
 * contoller method invocations by the form api.  Note that currently there is
 * no constructor in the FormBase class.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class BuildDemo extends FormBase {

  public function __construct() {
    // Static variables here are used to tell you how often these methods
    // are called within a single page load.
    static $i=0;
    $i++;
    drupal_set_message("Constructor $i");
  }

  /**
   * Build form demonstration.
   *
   * This form demonstrates the different type of build form events and their
   * order of firing.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    static $i = 0;
    $i++;
    drupal_set_message("buildForm $i");

    $form['change'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Change Me'),
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'message-wrapper',
      ],
    ];
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Submit',
    ];


    // Add button handlers.
    $form['actions']['button'] = [
      '#type' => 'button',
      '#value' => 'Rebuild',
    ];

    $form['actions']['rebuild'] = [
      '#type' => 'button',
      '#value' => 'Submit Rebuild',
      '#submit' => ['::rebuildFormSubmit']
    ];

    $form['actions']['ajaxsubmit'] = [
      '#type' => 'submit',
      '#value' => 'Ajax Submit',
      '#ajax' => [
        'callback' => '::ajaxSubmit',
        'wrapper' => 'message-wrapper',
      ]
    ];

    $form['messages'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'message-wrapper']
    ];

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
