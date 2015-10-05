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
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $content['intro'] = array(
      '#markup' => '<p>' . $this->t('Form examples to demonstrate comment UI solutions using the Drupal Form API.') . '</p>',
    );

    $content['links'] = [
      '#theme' => 'item_list',
      '#items' => [
        $this->l($this->t('Simple Form'), Url::fromRoute('fapi_example.simple_form')),
        $this->l($this->t('Input Demo'), Url::fromRoute('fapi_example.input_demo')),
        $this->l($this->t('Form State Example'), Url::fromRoute('fapi_example.state_demo')),
        $this->l($this->t('Container Demo'), Url::fromRoute('fapi_example.container_demo')),
        $this->l($this->t('Veritcal Tab Demo'), Url::fromRoute('fapi_example.vertical_tabs_demo')),
        $this->l($this->t('Ajax Demo'), Url::fromRoute('fapi_example.ajax_demo')),
        [
          '#type' => 'link',
          '#title' => $this->t('Modal Example'),
          '#url' => new Url('fapi_example.modal_form'),
          '#attributes' => [
            'class' => ['use-ajax'],
            'data-dialog-type' => 'modal',
            ]
        ],
        $this->l($this->t('Build Demo'), Url::fromRoute('fapi_example.build_demo')),
      ],
    ];
    $content['message'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attributes' => ['id' => 'fapi-example-message'],
    ];
    return $content;
  }

}
