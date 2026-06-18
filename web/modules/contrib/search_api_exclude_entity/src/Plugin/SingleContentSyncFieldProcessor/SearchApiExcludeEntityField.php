<?php

namespace Drupal\search_api_exclude_entity\Plugin\SingleContentSyncFieldProcessor;

use Drupal\Core\Entity\FieldableEntityInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\single_content_sync\SingleContentSyncFieldProcessorPluginBase;

/**
 * Field processor plugin for the Search API Exclude Entity field.
 *
 * @SingleContentSyncFieldProcessor(
 *   id = "search_api_exclude_entity_field",
 *   label = @Translation("Search API Exclude Entity Field"),
 *   field_type = "search_api_exclude_entity"
 * )
 */
class SearchApiExcludeEntityField extends SingleContentSyncFieldProcessorPluginBase {

  /**
   * {@inheritdoc}
   */
  public function exportFieldValue(FieldItemListInterface $field): array {
    // For a boolean field, return the field value.
    return $field->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function importFieldValue(FieldableEntityInterface $entity, string $fieldName, array $value): void {
    // Set the field value on the entity.
    $entity->set($fieldName, $value);
  }

}
