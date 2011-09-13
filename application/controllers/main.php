<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Document the Application Unit Test Reports
 * 
 * This application generates reports of the unit test
 * run for the given applications
 *
 * @author DCCS Bakers
 * @version 0.1
 * @package OWCN
 * @tutorial OWCN.pkg
 * @filesource
 */

/**
 * This is the class declaration for the Main class
 * @package OWCN
 */
class Main extends CI_Controller {

  /**
   * An instance variable to access our application root
   * @access private
   * @var string
   */
  private $application_root;
  private $site_name;

  public $debug = 0;
  public $debug_file = 'debug';


  /**
   * This is the class constuctor and it sets
   * the $application_root instance variable
   */
  public function __construct()
  {
    parent::__construct();

		$this->debug = FALSE;

error_log("this is the mvc controller: DOCROOT: " . $_SERVER['DOCUMENT_ROOT']);
    $this->application_root = $_SERVER['DOCUMENT_ROOT'];

		$this->site_name = preg_replace("/http:\/\/(.*?)\//", "$1", site_url());
error_log("this is the mvc controller: SITE_NAME: " . $this->site_name);

error_log("this is the mvc controller: SESSION: " . print_r($this->session, 1));
#		$this->session->set_userdata('site_name', $this->site_name);

		$this->debug = FALSE;
  }

	public function index()
	{
		$data = array(
			"page" => 'login',
			"function_status" => EXIT_SUCCESS,
		);

		$this->load->view('main/login', $data);

		return $data;
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
