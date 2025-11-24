<?php

namespace Drupal\ejercicio_kdb\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the EjercicioKdbValidation constraint.
 */
class EjercicioKdbValidationConstraintValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint) {
    if (!isset($entity)) {
      return;
    }

    /** @var \Drupal\ejercicio_kdb\Entity\EjercicioKdb $entity */
    // Check if fields exist and have values.
    if ($entity->get('dato_1')->isEmpty() || $entity->get('dato_2')->isEmpty()) {
      return;
    }

    $dato_1 = $entity->get('dato_1')->first()->getValue()['value'];
    $dato_2 = $entity->get('dato_2')->first()->getValue()['value'];

    // Check if dato_1 and dato_2 are the same.
    if ($dato_1 == $dato_2) {
      $this->context->addViolation($constraint->sameValuesMessage);
      return;
    }

    // Check if an entity with the same dato_1 and dato_2 already exists.
    $storage = \Drupal::entityTypeManager()->getStorage('ejercicio_kdb');
    $query = $storage->getQuery()
      ->condition('dato_1', $dato_1)
      ->condition('dato_2', $dato_2)
      ->accessCheck(FALSE);

    // Exclude the current entity if it's being edited.
    if (!$entity->isNew()) {
      $query->condition('id', $entity->id(), '<>');
    }

    $existing_entities = $query->execute();

    if (!empty($existing_entities)) {
      $this->context->addViolation($constraint->duplicateMessage, [
        '%dato_1' => $dato_1,
        '%dato_2' => $dato_2,
      ]);
    }
  }

}
