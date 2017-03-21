<?php

namespace Drupal\Tests\hook_event_dispatcher\Preprocess;

use Drupal\hook_event_dispatcher\Event\Preprocess\BlockPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\EckEntityPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\FieldPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\FormPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\HtmlPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\ImagePreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\NodePreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\PagePreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\ViewFieldPreprocessEvent;
use Drupal\hook_event_dispatcher\Event\Preprocess\ViewPreprocessEvent;
use Drupal\hook_event_dispatcher\Service\PreprocessEventService;
use Drupal\Tests\hook_event_dispatcher\Preprocess\Helpers\YamlDefinitionsLoader;
use Drupal\Tests\hook_event_dispatcher\Preprocess\Helpers\SpyEventDispatcher;

/**
 * Class ServiceTest.
 */
final class ServiceTest extends \PHPUnit_Framework_TestCase {

  /**
   * PreprocessEventService.
   *
   * @var PreprocessEventService
   *   PreprocessEventService.
   */
  private $service;

  /**
   * SpyEventDispatcher.
   *
   * @var SpyEventDispatcher
   *   SpyEventDispatcher
   */
  private $dispatcher;

  /**
   * Variables array.
   *
   * @var array
   *   Variables.
   */
  private $variables = [];

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    $loader = YamlDefinitionsLoader::getInstance();
    $this->dispatcher = new SpyEventDispatcher();
    $this->service = new PreprocessEventService($this->dispatcher, $loader->getMapper());
  }

  /**
   * Test a BlockPreprocessEvent.
   */
  public function testBlockEvent() {
    $this->createAndAssertEvent(BlockPreprocessEvent::class);
  }

  /**
   * Test a EckEntityPreprocessEvent.
   */
  public function testEckEntityEvent() {
    $this->createAndAssertEvent(EckEntityPreprocessEvent::class);
  }

  /**
   * Test a FieldPreprocessEvent.
   */
  public function testFieldEvent() {
    $this->createAndAssertEvent(FieldPreprocessEvent::class);
  }

  /**
   * Test a FormPreprocessEvent.
   */
  public function testFormEvent() {
    $this->createAndAssertEvent(FormPreprocessEvent::class);
  }

  /**
   * Test a HtmlPreprocessEvent.
   */
  public function testHtmlEvent() {
    $this->createAndAssertEvent(HtmlPreprocessEvent::class);
  }

  /**
   * Test a ImagePreprocessEvent.
   */
  public function testImageEvent() {
    $this->createAndAssertEvent(ImagePreprocessEvent::class);
  }

  /**
   * Test a NodePreprocessEvent.
   */
  public function testNodeEvent() {
    $this->createAndAssertEvent(NodePreprocessEvent::class);
  }

  /**
   * Test a PagePreprocessEvent.
   */
  public function testPageEvent() {
    $this->createAndAssertEvent(PagePreprocessEvent::class);
  }

  /**
   * Test a ViewFieldPreprocessEvent.
   */
  public function testViewFieldEvent() {
    $this->createAndAssertEvent(ViewFieldPreprocessEvent::class);
  }

  /**
   * Test a ViewPreprocessEvent.
   */
  public function testViewEvent() {
    $this->createAndAssertEvent(ViewPreprocessEvent::class);
  }

  /**
   * Test a unknown hook.
   */
  public function testNotMappingEvent() {
    $this->service->createAndDispatchKnownEvent('NoneExistingHook', $this->variables);
    $this->assertEquals(NULL, $this->dispatcher->getLastEventName());
    $this->assertEquals(NULL, $this->dispatcher->getLastEvent());
  }

  /**
   * Create and assert the given event class.
   *
   * @param string $class
   *   Event class name.
   */
  private function createAndAssertEvent($class) {
    $this->service->createAndDispatchKnownEvent($class::getHook(), $this->variables);
    $this->assertEquals($class::name(), $this->dispatcher->getLastEventName());
    $this->assertInstanceOf($class, $this->dispatcher->getLastEvent());
  }

}
