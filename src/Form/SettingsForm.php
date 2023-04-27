<?php

namespace Drupal\gurman_telegram\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'gurman_telegram_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['gurman_telegram.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['tg_bot_token'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Токен бота'),
      '#default_value' => $this->config('gurman_telegram.settings')->get('tg_bot_token'),
    ];

    $form['tg_channel_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Ид группы'),
      '#default_value' => $this->config('gurman_telegram.settings')->get('tg_channel_id'),
    ];
    $form['tg_channel_id']['#placeholder'] = '@my_channel';

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    return;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('gurman_telegram.settings')
      ->set('tg_channel_id', $form_state->getValue('tg_channel_id'))
      ->set('tg_bot_token', $form_state->getValue('tg_bot_token'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
