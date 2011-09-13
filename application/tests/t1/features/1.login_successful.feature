Feature: Display login page.
	A web client goes to the OWCN site login page.
	
	Scenario Outline:  A web client goes to the OWCN site login page.
		Given that the client goes to the <login_page>
		Then the client should get the login page.

	Examples:
		|login_page|
		|"blueskies.ucdavis.edu:/"|

