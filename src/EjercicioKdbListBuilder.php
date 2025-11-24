<?php

namespace Drupal\ejercicio_kdb;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines a class to build a listing of Ejercicio KDB entities.
 */
class EjercicioKdbListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['dato_1'] = $this->t('Dato 1');
    $header['dato_2'] = $this->t('Dato 2');
    $header['etiqueta'] = $this->t('Etiqueta');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\ejercicio_kdb\Entity\EjercicioKdb $entity */
    $row['id'] = $entity->id();
    $row['dato_1'] = $entity->get('dato_1')->value;
    $row['dato_2'] = $entity->get('dato_2')->value;

    // Display the taxonomy term label.
    if (!$entity->get('etiqueta')->isEmpty()) {
      $term = $entity->get('etiqueta')->entity;
      $row['etiqueta'] = $term ? $term->label() : '';
    }
    else {
      $row['etiqueta'] = '';
    }

    return $row + parent::buildRow($entity);
  }

}
