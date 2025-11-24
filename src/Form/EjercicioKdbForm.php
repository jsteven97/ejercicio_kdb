<?php

namespace Drupal\ejercicio_kdb\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form handler for the Ejercicio KDB add and edit forms.
 */
class EjercicioKdbForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = parent::save($form, $form_state);

    $message_arguments = ['%label' => $entity->id()];
    $logger_arguments = [
      '%label' => $entity->id(),
      'link' => $entity->toLink($this->t('View'))->toString(),
    ];

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addStatus($this->t('Created new Ejercicio KDB entity %label.', $message_arguments));
        $this->logger('ejercicio_kdb')->notice('Created new Ejercicio KDB entity %label.', $logger_arguments);
        break;

      case SAVED_UPDATED:
        $this->messenger()->addStatus($this->t('Updated Ejercicio KDB entity %label.', $message_arguments));
        $this->logger('ejercicio_kdb')->notice('Updated Ejercicio KDB entity %label.', $logger_arguments);
        break;
    }

    $form_state->setRedirect('entity.ejercicio_kdb.collection');

    return $status;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    // Get values safely.
    $dato_1_value = $form_state->getValue('dato_1');
    $dato_2_value = $form_state->getValue('dato_2');

    // Check if values exist.
    if (empty($dato_1_value) || empty($dato_2_value)) {
      return;
    }

    // Extract the actual values.
    $dato_1 = is_array($dato_1_value) && isset($dato_1_value[0]['value']) ? $dato_1_value[0]['value'] : NULL;
    $dato_2 = is_array($dato_2_value) && isset($dato_2_value[0]['value']) ? $dato_2_value[0]['value'] : NULL;

    if ($dato_1 === NULL || $dato_2 === NULL) {
      return;
    }

    // Validation 1: dato_1 and dato_2 cannot be the same.
    if ($dato_1 == $dato_2) {
      $form_state->setErrorByName('dato_2', $this->t('Dato 1 and Dato 2 cannot have the same value.'));
      return;
    }

    // Validation 2: Check if exists node with the same dato_1 & dato_2 already.
    $entity = $this->entity;
    $storage = $this->entityTypeManager->getStorage('ejercicio_kdb');

    $query = $storage->getQuery()
      ->condition('dato_1', $dato_1)
      ->condition('dato_2', $dato_2)
      ->accessCheck(FALSE);

    // If editing, exclude the current entity from the check.
    if (!$entity->isNew()) {
      $query->condition('id', $entity->id(), '<>');
    }

    $existing_entities = $query->execute();

    if (!empty($existing_entities)) {
      $form_state->setError($form, $this->t('An entity with Dato 1 = @dato_1 and Dato 2 = @dato_2 already exists.', [
        '@dato_1' => $dato_1,
        '@dato_2' => $dato_2,
      ]));
    }
  }

}
