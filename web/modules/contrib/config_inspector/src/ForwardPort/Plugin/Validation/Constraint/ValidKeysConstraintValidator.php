<?php

declare(strict_types=1);

namespace Drupal\config_inspector\ForwardPort\Plugin\Validation\Constraint;

use Drupal\Core\Validation\Plugin\Validation\Constraint\ValidKeysConstraintValidator as OriginalValidator;
use Symfony\Component\Validator\Constraint;

// phpcs:ignore Drupal.Commenting.ClassComment.Missing
class ValidKeysConstraintValidator extends OriginalValidator {

  /**
   * {@inheritdoc}
   */
  public function validate(mixed $value, Constraint $constraint): void {
    // If the value is NULL, then the `NotNull` constraint validator will
    // set the appropriate validation error message.
    // @see \Drupal\Core\Validation\Plugin\Validation\Constraint\NotNullConstraintValidator
    if ($value === NULL) {
      return;
    }
    parent::validate($value, $constraint);
  }

}
