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
class VerticalTabsDemo extends DemoBase {

  /**
   * Build the simple form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['information'] = array(
      '#type' => 'vertical_tabs',
      '#default_tab' => 'edit-publication',
    );

   $form['author'] = array(
     '#type' => 'details',
     '#title' => 'Author',
     '#group' => 'information',
   );

   $form['author']['name'] = array(
     '#type' => 'textfield',
     '#title' => t('Name'),
   );

   $form['publication'] = array(
     '#type' => 'details',
     '#title' => t('Publication'),
     '#group' => 'information',
   );

   $form['publication']['publisher'] = array(
     '#type' => 'textfield',
     '#title' => t('Publisher'),
   );

    $form['actions'] = ['#type' => 'actions'];
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
    return 'fapi_example_vertical_tabs_demo';
  }

}
