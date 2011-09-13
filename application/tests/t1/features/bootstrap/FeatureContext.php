<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//
set_include_path(get_include_path() . PATH_SEPARATOR . '/home/daryl/Projects/Behat_CI_Test/');
echo "FeatureContext: INCPATH: ", get_include_path(), "<br/>\n";
require_once 'application/tests/config/ci-config.php';
require_once 'application/controllers/main.php';
echo "FeatureContext: LOADED: mvc main controller....<br/>\n";
require_once 'application/tests/config/classes.php';

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
	public $data;

	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param   array   $parameters     context parameters (set them up through behat.yml)
	 */
	public function __construct(array $parameters)
	{
		// Initialize your context here
		$this->controller = new testController();
	}

	/**
	 * @Given /^that the client goes to the "([^"]*)"$/
	 */
	public function thatTheClientGoesToThe($argument1)
	{
		$this->data = $this->controller->index();
		echo "DATA: ", print_r($this->data, 1), "\n";
	}

	/**
	 * @Then /^the client should get the login page\.$/
	 */
	public function theClientShouldGetTheLoginPage()
	{
	  assertArrayHasKey('function_status', $this->data, 'The element "function_status" is missing from data.');
	  assertEquals(EXIT_SUCCESS, $this->data['function_status']);

	  assertArrayHasKey('page', $this->data, 'The element "page" is missing from data.');
	  assertEquals("login", $this->data['page']);
	}
}
