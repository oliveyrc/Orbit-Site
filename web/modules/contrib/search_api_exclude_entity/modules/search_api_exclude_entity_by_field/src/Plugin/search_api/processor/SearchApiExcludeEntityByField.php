<?php

namespace Drupal\search_api_exclude_entity_by_field\Plugin\search_api\processor;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\PluginFormInterface;
use Drupal\search_api\Plugin\PluginFormTrait;
use Drupal\search_api\Processor\ProcessorPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Excludes entities marked as 'excluded' from being indexes.
 *
 * @SearchApiProcessor(
 *   id = "search_api_exclude_entity_by_field_processor",
 *   label = @Translation("Search API Exclude Entity By Field"),
 *   description = @Translation("Exclude some items from being indexed depends of the field values."),
 *   stages = {
 *     "alter_items" = -50
 *   }
 * )
 */
class SearchApiExcludeEntityByField extends ProcessorPluginBase implements PluginFormInterface {

  use PluginFormTrait;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    /** @var static $processor */
    $processor = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    return $processor;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $config = $this->getConfiguration();

    $fields = $this->index->getFields();
    foreach ($fields as $field) {
      $fieldName = $field->getFieldIdentifier();
      $form['fields'][$fieldName] = [
        '#type' => 'textfield',
        '#title' => $field->getLabel(),
        '#description' => $this->t("The item won't be in the index if the field has this value"),
        '#default_value' => $config['fields'][$fieldName] ?? '',
        '#multiple' => TRUE,
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    $values = $form_state->getValues();
    $indexName = $this->index->getOriginalId();

    // Remove empty values.
    if (isset($values[$indexName]['fields']) && is_array($values[$indexName]['fields'])) {
      $values[$indexName]['fields'] = array_filter($values[$indexName]['fields']);
    }

    $this->setConfiguration($values);
  }

  /**
   * {@inheritdoc}
   */
  public function alterIndexedItems(array &$items): void {
    $config = $this->getConfiguration();
    $indexName = $this->index->getOriginalId();
    $configuredField = $config[$indexName]['fields'];

    /** @var \Drupal\search_api\Item\ItemInterface $item */
    foreach ($items as $item_id => $item) {
      try {
        $object = $item->getOriginalObject()->getValue();
        $fieldList = $object->getFields();

        foreach ($configuredField as $fieldName => $fieldValue) {
          if (isset($fieldList[$fieldName])) {
            $value = $fieldList[$fieldName]->getValue();
            $value = $value[0]['value'];
            if ($value == $this->sanitizeFilterString($fieldValue)) {
              unset($items[$item_id]);
            }
          }
        }
      }
      catch (\Exception) {
        $this->messenger->addError($this->t('Error getting item object from Search API Entity Exclude By Field plugin.'));
      }
    }
  }

  /**
   * Sanitize the values of the field depends on the comparison type.
   *
   * @param mixed $value
   *   The value to be sanitized.
   *
   * @return mixed
   *   The sanitized value.
   */
  protected function sanitizeFilterString(mixed $value): mixed {
    if ($value == 'false') {
      return FALSE;
    }
    if ($value == 'true') {
      return TRUE;
    }

    return $value;
  }

}
