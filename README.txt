Folks,

I have been using Behat version 1 to succesfully instantiate and extend
a CodeIgniter controller and test different methods in the controller.
When I have tried the doing this with Behat version 2, Behat dies with
with the php error message:

PHP Fatal error: Call to a member function set_userdata() on a non-
object in …

the mentioned function is a method of the CodeIngniter session class
library.

I am trying to instantiate the test controller that extends the
CodeIgniter controller in the bootstrap/FeatureContext.php file.

Now the interesting thing is that the object is instantiated and the
session method can be accessed before Behat begins running/parsing
through the story. I can error_log session variables, etc. but once it
starts to print the story the object somehow gets stomped on and it
dies with the above error message. And if you don't try to access
the session object at all, the test succeeds. The MVC controller
returns a data array that is used to test for success or failure.

To summarize, my FeatureContext constructor instantiates my test
controller, i.e:

public function __construct(array $parameters)
{
  // Initialize your context here
  $this->controller = new testController();

}

my test controller (which extends the CodeIgniter controller) invokes
the parent::__construct() method, the session data is printed by the
MVC controller, Behat starts to print out “Feature: …”, the MVC
Controller prints out empty session data, and then Behat dies with
above fatal error.

So it appears that somewhere between when the time the original
CodeIgniter constructor is called and the time Behat starts to parse
the story, the CodeIgniter constructor gets clobbered somehow.

Any help, pointers, etc. would be greatly appreciated. I have truly
enjoyed working with Behat v1 and really want to get up to speed with
your current version.

Thank you, and Best Regards,

Daryl 
