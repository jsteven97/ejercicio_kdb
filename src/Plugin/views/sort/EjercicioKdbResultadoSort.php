<?php

namespace Drupal\ejercicio_kdb\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;

/**
 * Sort handler for Ejercicio KDB Resultado calculation.
 *
 * @ingroup views_sort_handlers
 *
 * @ViewsSort("ejercicio_kdb_resultado_sort")
 */
class EjercicioKdbResultadoSort extends SortPluginBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $this->ensureMyTable();

    // Build the SQL expression for Resultado.
    $formula = "({$this->tableAlias}.dato_1 * 5) + ({$this->tableAlias}.dato_2 * 10)";

    // Add the ORDER BY clause.
    $this->query->addOrderBy(NULL, $formula, $this->options['order'], $this->tableAlias . '_resultado');
  }

}
