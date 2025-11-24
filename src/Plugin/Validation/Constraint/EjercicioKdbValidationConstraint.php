<?php

namespace Drupal\ejercicio_kdb\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that dato_1 and dato_2 are not the same and the combination is unique.
 *
 * @Constraint(
 *   id = "EjercicioKdbValidation",
 *   label = @Translation("Ejercicio KDB Validation", context = "Validation"),
 * )
 */
class EjercicioKdbValidationConstraint extends Constraint {

  /**
   * The message for same values.
   *
   * @var string
   */
  public $sameValuesMessage = 'Dato 1 and Dato 2 cannot have the same value.';

  /**
   * The message for duplicate entities.
   *
   * @var string
   */
  public $duplicateMessage = 'An entity with Dato 1 = %dato_1 and Dato 2 = %dato_2 already exists.';

  /**
   * {@inheritdoc}
   */
  public function validatedBy() {
    return '\Drupal\ejercicio_kdb\Plugin\Validation\Constraint\EjercicioKdbValidationConstraintValidator';
  }

}
