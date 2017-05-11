<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testShowSecondTagItemfromIndex()
    {

        // this link is available to users who are not authenticated
        $client = static::createClient();

        $client->followRedirects(true);
        $crawler = $client->request('GET', '/tag');
        $link= $crawler->selectLink('show')
            ->eq(1)
            ->link();

        $this->assertEquals(

            $link->getUri(),'http://localhost/tag/2');

    }

    //this test tests that the back to the list link in the show view of a tag is correct

    public function testgoBackOneLevel()
    {

        // this link is available to users who are not authenticated
        $client = static::createClient();

        $client->followRedirects(true);
        $crawler = $client->request('GET', '/tag/2');
        $link= $crawler->selectLink('Back to the list')->link();;


        $this->assertEquals(

            $link->getUri(),'http://localhost/tag/');

    }


    public function testUpVotingButton()
    {

        // this link is available to users who are not authenticated
        $client = static::createClient();


        $client->followRedirects(true);
        $crawler = $client->request('GET', '/tag');
        $link= $crawler->selectLink('Upvote')
            ->eq("1")
            ->link();
        $this->assertEquals(

            $link->getUri(),'http://localhost/tag/2/upvote');



    }

    public function testDownVotingButton()
    {

        // this link is available to users who are not authenticated
        $client = static::createClient();

        $client->followRedirects(true);
        $crawler = $client->request('GET', '/tag');
        $link= $crawler->selectLink('Downvote')
            ->eq("1")
            ->link();
        $this->assertEquals(

            $link->getUri(),'http://localhost/tag/2/downvote');

    }

    public function testvalidLogin()
    {

        $client = static::createClient();

        $client->followRedirects(true);
        $crawler = $client->request('GET', '/tag');


        // this is a valid login who not authenticated

        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'john.ogrady@iwa.ie',
            'PHP_AUTH_PW'   => 'pass',
        ));



        $crawler = $client->request('GET','/ref/ref/approve');

        $link= $crawler->selectLink('edit')
            ->eq(1)
            ->link();
        $this->assertEquals(
            $link->getUri(),'http://localhost/ref/2/edit');

    }

    public function testNotValidLogin()
    {

        $client = static::createClient();
        $client->followRedirects(true);
//try to navigate to the protected author index which requires login
        $client->request('GET', '/author', array(), array(), array(
            'PHP_AUTH_USER' => 'notAUSERNAME',
            'PHP_AUTH_PW'   => 'WotsApa$$word',
        ));        $client->followRedirects(true);

        // this not a valid login

// check that we're still on the login page
        $this->assertEquals(
            $client->getRequest()->getUri(),'http://localhost/login');

    }

}
