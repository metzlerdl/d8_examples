<?php
/**
 * Input Element Demo
 */

namespace Drupal\fapi_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class InputDemo extends FormBase {

  /**
   * Form Building function.
   * @param array $form
   *   Partially built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object representating the state of the form.
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // CheckBoxes
    $form['tests_taken'] = array(
      '#type' => 'checkboxes',
      '#options' => array('SAT' => t('SAT'), 'ACT' => t('ACT')),
      '#title' => $this->t('What standardized tests did you take?'),
      '#description' => 'Checkboxes, #type = checkboxes',
    );

    // Color
    $form['color'] = array(
      '#type' => 'color',
      '#title' => $this->t('Color'),
      '#default_value' => '#ffffff',
      '#description' => 'Color, #type = color',
    );

    // Date
    $form['expiration'] = array(
      '#type' => 'date',
      '#title' => $this->t('Content expiration'),
      '#default_value' => array('year' => 2020, 'month' => 2, 'day' => 15,),
      '#description' => 'Date, #type = date',
    );

    // Email
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => 'Email, #type = email',
    );

    // Number
    $form['quantity'] = array(
      '#type' => 'number',
      '#title' => t('Quantity'),
      'description' => $this->t('Number, #type = number'),
    );

    // Password
    $form['password'] = array(
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#description' => 'Password, #type = password',
    );

    // Password Confirm
    $form['password_confirm'] = array(
      '#type' => 'password_confirm',
      '#title' => $this->t('New Password'),
      '#description' => $this->t('PasswordConfirm, #type = password_confirm')
    );

    // Range
    $form['size'] = array(
      '#type' => 'range',
      '#title' => t('Size'),
      '#min' => 10,
      '#max' => 100,
      '#discription' => $this->t('Range, #type = range'),
    );

    // Radios
    $form['settings']['active'] = array(
      '#type' => 'radios',
      '#title' => t('Poll status'),
      '#options' => array(0 => $this->t('Closed'), 1 => $this->t('Active')),
      '#description' => $this->t('Radios, #type = radios'),
    );

    // Search
    $form['search'] = array(
      '#type' => 'search',
      '#title' => $this->t('Search'),
      '#description' => $this->t('Search, #type = search'),
    );

    // Select
    $form['favorite'] = array(
      '#type' => 'select',
      '#title' => $this->t('Favorite color'),
      '#options' => array(
        'red' => $this->t('Red'),
        'blue' => $this->t('Blue'),
        'green' => $this->t('Green')
      ),
      '#empty_option' => $this->t('-select-'),
      '#description' => $this->t('Select, #type = select'),
    );

    // Tel
    $form['phone'] = array(
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
      '#description' => $this->t('Tel, #type = tel'),
    );

    // TableSelect
    $options = [
      1 => ['first_name' => 'Indy', 'last_name' => 'Jones'],
      2 => ['first_name' => 'Darth', 'last_name' => 'Vader'],
      3 => [ 'first_name' => 'Super', 'last_name' => 'Man'],
    ];

    $header = array(
      'first_name' => t('First Name'),
      'last_name' => t('Last Name'),
    );

    $form['table'] = array(
      '#type' => 'tableselect',
      '#title' => $this->t('Users'),
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No users found'),
    );

    // Textarea
    $form['text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Text'),
      '#description' => $this->t('Textarea, #type = textarea')
    );

    // Textfield
    $form['subject'] = array(
      '#type' => 'textfield',
      '#title' => t('Subject'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Textfield, #type = textfield'),
    );

    // Weight
    $form['weight'] = array(
      '#type' => 'weight',
      '#title' => t('Weight'),
      '#delta' => 10,
      '#description' => $this->t('Weight, #type = weight')
    );


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
      '#description' => $this->t('Submit, #type = submit')
    );


    return $form;
  }

  /**
   * The form ID as used in alter hooks.
   */
  public function getFormId() {
    return 'fapi_example_input_demo_form';
  }

  /**
   * @param array $form
   *   The built version of the render array representing the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //Find out what was submitted
    $values = $form_state->getValues();
    foreach($values  as $key => $value) {
      $label = $form[$key]['#title'];

      // many arrays return 0 for unselected values so lets filter that out.
      if (is_array($value)) $value = array_filter($value);

      // Only display for controls that have titles and values.
      if ($value && $label ) {
        $display_value = is_array($value) ? print_r($value, 1) : $value;
        $message = $this->t('Value for %title: %value' , array('%title' => $label, '%value' => $display_value));
        drupal_set_message($message);
      }
    }
  }

}