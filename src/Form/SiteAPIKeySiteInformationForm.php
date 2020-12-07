<?php
 
namespace Drupal\site_api_key\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\system\Form\SiteInformationForm;
 
/**
 * Extend SiteInformationForm for siteapikey.
 */
class SiteAPIKeySiteInformationForm extends SiteInformationForm {
 
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
  
    $site_config = $this->config('system.site');
    $form = parent::buildForm($form, $form_state);
 
    // Add "Site API Key" Text Field
    $default_value = $site_config->get('siteapikey') ?? 'No API Key yet';
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site API Key'),
      '#default_value' => $default_value,
      '#description' => $this->t('Site API Key'),
    ];

    // If Site Key is set and not empty then update the submit button text.
    $save_button_text = $site_config->get('siteapikey');
    $save_button_text = isset($save_button_text) && $save_button_text != '' ? 'Update configuration' : 'Save configuration';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t($save_button_text),
      '#button_type' => 'primary',
    );
 
    return $form;
  }
 
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Fetch Site Configuration.
    $config = $this->config('system.site');
 
    $siteapikey = $form_state->getValue('siteapikey');
    $config->set('siteapikey', $siteapikey);
 
    $config ->save();

    // If Site Key is set and not empty.
    if (isset($siteapikey) && $siteapikey != '') {
      $this->messenger()->addStatus($this->t('The Site API Key (%key) has been saved.', [
        '%key' => $siteapikey,
      ]));
    }

    // Call parent form method to pass on the newly added field value.
    parent::submitForm($form, $form_state);
  }
}