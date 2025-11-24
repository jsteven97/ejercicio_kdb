<?php

namespace Drupal\ejercicio_kdb\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides settings form for managing EjercicioKDB entity field configuration.
 *
 * @package Drupal\ejercicio_kdb\Form
 */
class EjercicioKdbSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ejercicio_kdb_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['settings'] = [
      '#markup' => $this->t('Settings form for Ejercicio KDB entity. Manage field settings using the tabs above.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation as this is just a placeholder form.
  }

}
