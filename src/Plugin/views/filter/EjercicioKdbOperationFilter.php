<?php

namespace Drupal\ejercicio_kdb\Plugin\views\filter;

use Drupal\views\Plugin\views\filter\FilterPluginBase;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\ViewExecutable;
use Drupal\Core\Form\FormStateInterface;

/**
 * Filter handler for Ejercicio KDB operations between fields.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("ejercicio_kdb_operation_filter")
 */
class EjercicioKdbOperationFilter extends FilterPluginBase {

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, ?array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->valueTitle = $this->t('Operation type');
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['operation'] = ['default' => 'sum'];
    $options['operator'] = ['default' => '>'];
    $options['value'] = ['default' => ''];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['operation'] = [
      '#type' => 'select',
      '#title' => $this->t('Operation'),
      '#description' => $this->t('Select the operation to perform between Dato 1 and Dato 2.'),
      '#options' => [
        'resultado' => $this->t('resultado ((Dato 1 * 5) + (Dato 2 * 10))'),
      ],
      '#default_value' => $this->options['operation'],
    ];

    $form['value'] = [
      '#type' => 'number',
      '#title' => $this->t('Value'),
      '#description' => $this->t('The value to compare the operation result against.'),
      '#default_value' => $this->options['value'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function query() {
    $this->ensureMyTable();

    $operation = $this->options['operation'];
    $operator = $this->options['operator'];
    $value = $this->options['value'];

    // Build the SQL expression based on the selected operation.
    switch ($operation) {

      case 'resultado':
        $expression = "({$this->tableAlias}.dato_1 * 5) + ({$this->tableAlias}.dato_2 * 10)";
        break;

      default:
        $expression = "{$this->tableAlias}.dato_1 + {$this->tableAlias}.dato_2";
    }

    // Add the WHERE condition.
    $this->query->addWhereExpression(
      $this->options['group'],
      "{$expression} {$operator} :value",
      [':value' => $value]
    );
  }

  /**
   * {@inheritdoc}
   */
  public function adminSummary() {
    $operations = [
      'resultado' => $this->t('Resultado'),
    ];

    $operation_label = $operations[$this->options['operation']] ?? $this->options['operation'];
    $operator = $this->options['operator'];
    $value = $this->options['value'];

    return $this->t('@operation @operator @value', [
      '@operation' => $operation_label,
      '@operator' => $operator,
      '@value' => $value,
    ]);
  }

}
