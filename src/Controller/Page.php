<?php

/**
 * @file
 * Contains Drupal\fapi_example\Controller\Page.
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
    // These libraries are required to facilitate the ajax modal form demo.
    $content['#attached']['library'][] = 'core/drupal.ajax';
    $content['#attached']['library'][] = 'core/drupal.dialog';
    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
    $content['intro'] = [
      '#markup' => '<p>' . $this->t('Form examples to demonstrate comment UI solutions using the Drupal Form API.') . '</p>',
    ];

    // Create a bulleted list of links to the form examples.
    $content['links'] = [
      '#theme' => 'item_list',
      '#items' => [
        $this->l($this->t('Simple Form'), Url::fromRoute('fapi_example.simple_form')),
        $this->l($this->t('Input Demo'), Url::fromRoute('fapi_example.input_demo')),
        $this->l($this->t('Form State Example'), Url::fromRoute('fapi_example.state_demo')),
        $this->l($this->t('Container Demo'), Url::fromRoute('fapi_example.container_demo')),
        $this->l($this->t('Vertical Tab Demo'), Url::fromRoute('fapi_example.vertical_tabs_demo')),
        $this->l($this->t('Ajax Demo'), Url::fromRoute('fapi_example.ajax_demo')),

        // The following link is generated by the link Render element.  I used
        // this so that the appropriate attributes could be set on the link.
        // the l method doesn't take these parameters.
        // Attributes are used by the core dialog libraries to invoke the modal.
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

    // The message container is used by the modal form example it is an empty
    // tag that will be replaced by content.
    $content['message'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'fapi-example-message'],
    ];
    return $content;
  }

}
