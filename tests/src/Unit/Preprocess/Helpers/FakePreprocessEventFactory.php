<?php

namespace Drupal\Tests\hook_event_dispatcher\Unit\Preprocess\Helpers;

use Drupal\hook_event_dispatcher\Event\Preprocess\Factory\PreprocessEventFactoryInterface;
use Drupal\hook_event_dispatcher\Event\Preprocess\Variables\DefaultEventVariables;

/**
 * Class FakePreprocessEventFactory.
 *
 * @package Drupal\Tests\hook_event_dispatcher\Preprocess\Helpers
 */
final class FakePreprocessEventFactory implements PreprocessEventFactoryInterface {

  /**
   * Fake hook.
   *
   * @var string
   */
  private $hook;

  /**
   * FakePreprocessEventFactory constructor.
   *
   * @param string $hook
   *   Fake hook.
   */
  public function __construct($hook) {
    $this->hook = $hook;
  }

  /**
   * Create the PreprocessEvent with the Variables object embedded.
   *
   * @param array $variables
   *   Variables.
   *
   * @return FakePreprocessEvent
   *   Created event.
   */
  public function createEvent(array &$variables) {
    return new FakePreprocessEvent(new DefaultEventVariables($variables));
  }

  /**
   * Get the Event hook name.
   *
   * @return string
   *   The hook name.
   */
  public function getEventHook() {
    return $this->hook;
  }

}
