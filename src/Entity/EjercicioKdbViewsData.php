<?php

namespace Drupal\ejercicio_kdb\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Ejercicio KDB entities.
 */
class EjercicioKdbViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Add a custom field that shows the weighted calculation.
    $data['ejercicio_kdb']['resultado_field'] = [
      'title' => $this->t('Resultado'),
      'help' => $this->t('The weighted calculation: (Dato 1 * 5) + (Dato 2 * 10).'),
      'field' => [
        'id' => 'ejercicio_kdb_calculated_field',
        'calculation' => 'resultado',
      ],
      'sort' => [
        'id' => 'ejercicio_kdb_resultado_sort',
      ],
    ];

    return $data;
  }

}
