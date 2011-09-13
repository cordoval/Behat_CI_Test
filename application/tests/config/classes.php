<?php

/**
 * our test environment does not instantiate the CI_Output class
 * so we mock it up here, so the CI_Controller is happy.
 */
class CI_Output {
	function append_output()
	{
	}
}

class testController extends Main {

	public $output;
	public $request_uri = "/main/login";

	function __construct()
	{
		$_SERVER = array();
		$_SERVER['DOCUMENT_ROOT'] = "/home/daryl/Projects/Behat_CI_Test";
		$_SERVER['HTTP_HOST'] = "blueskies.ucdavis.edu";
		$_SERVER['REMOTE_ADDR'] = "127.0.0.1";
		$_SERVER['HTTP_USER_AGENT'] = "Behat/2.0.5";
		$_SERVER['REQUEST_URI'] = $this->request_uri;
		$_SERVER['argv'] = explode('/', $this->request_uri);

error_log("This is the extended object. invoking parent");
		parent::__construct();
error_log("This is the extended object. done invoking parent");

		$this->output = new CI_Output();
	}

	function provide_input($login=null, $passwd=null)
	{
		$_POST['email'] = $login;
		$_POST['password'] = $passwd;

		return $_POST;
	}
}

?>
