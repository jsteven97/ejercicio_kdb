<?php

namespace Drupal\ejercicio_kdb\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Ejercicio KDB entity.
 *
 * @ContentEntityType(
 *   id = "ejercicio_kdb",
 *   label = @Translation("Ejercicio KDB"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ejercicio_kdb\EjercicioKdbListBuilder",
 *     "views_data" = "Drupal\ejercicio_kdb\Entity\EjercicioKdbViewsData",
 *     "form" = {
 *       "default" = "Drupal\ejercicio_kdb\Form\EjercicioKdbForm",
 *       "add" = "Drupal\ejercicio_kdb\Form\EjercicioKdbForm",
 *       "edit" = "Drupal\ejercicio_kdb\Form\EjercicioKdbForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "ejercicio_kdb",
 *   admin_permission = "administer ejercicio_kdb entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/ejercicio-kdb/{ejercicio_kdb}",
 *     "add-form" = "/ejercicio-kdb/add",
 *     "edit-form" = "/ejercicio-kdb/{ejercicio_kdb}/edit",
 *     "delete-form" = "/ejercicio-kdb/{ejercicio_kdb}/delete",
 *     "collection" = "/admin/content/ejercicio-kdb",
 *   },
 *   field_ui_base_route = "entity.ejercicio_kdb.settings",
 * )
 */
class EjercicioKdb extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Dato 1 field.
    $fields['dato_1'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Dato 1'))
      ->setDescription(t('Primer dato numérico (no puede ser igual a Dato 2).'))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'number_integer',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Dato 2 field.
    $fields['dato_2'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Dato 2'))
      ->setDescription(t('Segundo dato numérico (no puede ser igual a Dato 1).'))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'number_integer',
        'weight' => 1,
      ])
      ->setDisplayOptions('form', [
        'type' => 'number',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    // Etiqueta field - reference to tags taxonomy.
    $fields['etiqueta'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Etiqueta'))
      ->setDescription(t('Referencia a una etiqueta de taxonomía.'))
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler', 'default:taxonomy_term')
      ->setSetting('handler_settings', [
        'target_bundles' => [
          'tags' => 'tags',
        ],
      ])
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
        'weight' => 2,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 2,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
