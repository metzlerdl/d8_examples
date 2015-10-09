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
class ContainerDemo extends DemoBase {

  /**
   * Build the simple form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['author'] = [
        '#type' => 'details',
        '#title' => 'Author Info (type = details)',
    ];

    $form['author']['name'] = [
     '#type' => 'textfield',
     '#title' => $this->t('Name'),
    ];

    $form['author']['pen_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pen Name')
    ];

    $form['book'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Book Info (type = fieldset)'),
    ];

    $form['book']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
    ];

    $form['book']['publisher'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Publisher'),
    ];

    $form['accomodation'] = [
      '#type' => 'container',
    ];

    $form['accomodation']['title'] = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => $this->t('Special Accomodations (type = container)'),
    ];

    $form['accomodation'] ['diet'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Dietary Restrictions'),
    ];

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
    return 'fapi_example_container_demo';
  }


}
