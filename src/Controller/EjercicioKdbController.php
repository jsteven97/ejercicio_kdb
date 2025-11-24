<?php

namespace Drupal\ejercicio_kdb\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\ejercicio_kdb\Entity\EjercicioKdb;

/**
 * Provides route responses for the Ejercicio KDB entity.
 */
class EjercicioKdbController extends ControllerBase {

  /**
   * Title callback for the entity page.
   */
  public function title(EjercicioKdb $ejercicio_kdb) {
    return $this->t('Ejercicio KDB #@id', ['@id' => $ejercicio_kdb->id()]);
  }

}
