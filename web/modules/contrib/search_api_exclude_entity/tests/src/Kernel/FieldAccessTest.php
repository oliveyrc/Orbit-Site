<?php

namespace Drupal\Tests\search_api_exclude_entity\Kernel;

use Drupal\Core\Access\AccessResultAllowed;
use Drupal\Core\Access\AccessResultForbidden;
use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\user\Traits\UserCreationTrait;
use Drupal\entity_test\Entity\EntityTest;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;

/**
 * Tests the "Search API Exclude Entity" field access.
 *
 * @group search_api_exclude_entity
 */
class FieldAccessTest extends KernelTestBase {

  use UserCreationTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'entity_test',
    'field',
    'search_api_exclude_entity',
    'system',
    'user',
  ];

  /**
   * The name of the test field.
   */
  protected string $fieldName = 'field_test';

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->installEntitySchema('user');
    $this->installEntitySchema('entity_test');

    $this->installConfig(['field', 'system']);

    FieldStorageConfig::create([
      'field_name' => $this->fieldName,
      'type' => 'search_api_exclude_entity',
      'entity_type' => 'entity_test',
      'cardinality' => 1,
    ])->save();

    FieldConfig::create([
      'field_name' => $this->fieldName,
      'entity_type' => 'entity_test',
      'bundle' => 'entity_test',
      'label' => 'Test field',
    ])->save();
  }

  /**
   * Data provider for testing the "Search API Exclude Entity" field access.
   *
   * @return array
   *   The test data.
   */
  public function dataProviderFieldAccess(): array {
    return [
      'has-permission' => [
        TRUE,
      ],
      'not-has-permission' => [
        FALSE,
      ],
    ];
  }

  /**
   * Tests the "Search API Exclude Entity" field access.
   *
   * @dataProvider dataProviderFieldAccess
   */
  public function testFieldAccess(bool $has_permission): void {
    $account = $this->setUpCurrentUser([], [
      $has_permission ? 'edit search api exclude entity' : 'access content',
    ]);

    $entity = EntityTest::create([
      'name' => 'Test',
    ]);

    $field = $entity->get($this->fieldName);
    $result = $field->access('edit', $account, TRUE);

    if ($has_permission) {
      $this->assertInstanceOf(AccessResultAllowed::class, $result);
    }
    else {
      $this->assertInstanceOf(AccessResultForbidden::class, $result);
    }
  }

}
