<?php

/**
 * @file
 * Contains Drupal\form_example\Controller\Page.
 */

namespace Drupal\fapi_example\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Simple page controller for drupal.
 */
class Page extends ControllerBase {
  /**
   * Lists the examples provided by form_example.
   */
  public function description() {
    $content['intro'] = array(
      '#markup' => '<p>' . $this->t('Form examples to demonstrate comment UI solutions using the Drupal Form API.') . '</p>',
    );
    $content['links'] = array(
      '#theme' => 'item_list',
      '#items' => array(
        $this->l($this->t('Simple Form'), new Url('fapi_example.simple_form')),
        $this->l($this->t('Input Demo'), new Url('fapi_example.input_demo')),
      ),
    );
    return $content;
  }

}
