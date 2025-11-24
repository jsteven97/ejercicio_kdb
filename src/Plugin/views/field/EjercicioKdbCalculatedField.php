<?php

namespace Drupal\ejercicio_kdb\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field handler to display calculated values between Dato 1 and Dato 2.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("ejercicio_kdb_calculated_field")
 */
class EjercicioKdbCalculatedField extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Get the calculation type from field definition.
    $calculation = $this->definition['calculation'] ?? 'sum';
    // Ensure both fields are added to the query.
    $this->ensureMyTable();
    $this->addAdditionalFields(['dato_1', 'dato_2']);

    // Build the SQL expression.
    switch ($calculation) {

      case 'resultado':
        $expression = "({$this->tableAlias}.dato_1 * 5) + ({$this->tableAlias}.dato_2 * 10)";
        break;

      default:
        $expression = "{$this->tableAlias}.dato_1 + {$this->tableAlias}.dato_2";
    }

    // Add the calculated field.
    $this->field_alias = $this->query->addField(NULL, $expression, $this->tableAlias . '_calculated');
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $value = $this->getValue($values);
    return is_numeric($value) ? number_format($value, 2) : $this->t('N/A');
  }

}
