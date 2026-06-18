<?php

namespace Drupal\search_api_exclude_entity_metatag\Plugin\search_api\processor;

use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\metatag\MetatagManagerInterface;
use Drupal\search_api\Processor\ProcessorPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Excludes nodes with robots noindex from being indexed by Search API.
 *
 * @SearchApiProcessor(
 *   id = "search_api_exclude_entity_processor_metatag",
 *   label = @Translation("Search API Entity Exclude - Metatag No Index"),
 *   description = @Translation("Exclude entities with the noindex Metatag field set."),
 *   stages = {
 *     "alter_items" = 0,
 *   },
 * )
 */
class SearchApiExcludeEntityProcessorMetatag extends ProcessorPluginBase {

  /**
   * Metatag manager.
   *
   * @var \Drupal\metatag\MetatagManagerInterface
   */
  protected MetatagManagerInterface $metatagManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $processor = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $processor->setMetatagManager($container->get('metatag.manager'));
    return $processor;
  }

  /**
   * Sets the metatag manager service.
   *
   * @param \Drupal\metatag\MetatagManagerInterface $metatag_manager
   *   Metatag manager.
   */
  public function setMetatagManager(MetatagManagerInterface $metatag_manager): static {
    $this->metatagManager = $metatag_manager;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function alterIndexedItems(array &$items): void {
    /** @var \Drupal\search_api\Item\ItemInterface $item */
    foreach ($items as $item_id => $item) {
      $object = $item->getOriginalObject()->getValue();

      if ($object instanceof EntityPublishedInterface) {
        foreach ($this->metatagManager->tagsFromEntity($object) as $tag => $data) {
          if ($tag == 'robots' && str_contains($data, 'noindex')) {
            unset($items[$item_id]);
          }
        }
      }
    }
  }

}
