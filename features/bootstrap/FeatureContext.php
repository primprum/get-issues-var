<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $client = null;
    protected $results = null;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->client = new \Github\Client();
    }

    /**
     * @Given I am an anonymous user
     */
    public function iAmAnAnonymousUser()
    {
        // do nothing
    }

    /**
     * @When I request a list of issues from user :arg1 for the repository :arg2
     */
    public function iRequestAListOfIssuesFromUserForTheRepository($arg1, $arg2)
    {
        $issues = $this->client->issues()->all($arg1, $arg2);
        $statusCode = $this->client->getLastResponse()->getStatusCode();

        if ($statusCode != 200) {
            throw new Exception("Expected a 200 status code but got $statusCode instead!");
        }

        $this->results = $issues;
    }

    /**
     * @Then I should get at least :arg1 result
     */
    public function iShouldGetAtLeastResult($arg1)
    {
        if (count($this->results) < $arg1) {
            throw new Exception("Expected at least $arg1 result but got back " . count($this->results));
        }
    }

}
