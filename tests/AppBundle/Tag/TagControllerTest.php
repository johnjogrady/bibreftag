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
            'PHP_AUTH_PW'   => 'worldshy',
        ));
        var_dump($crawler);



        $crawler = $client->request('GET','/ref/ref/approve');
        var_dump($client->getRequest()->getUri());

        $link= $crawler->selectLink('Edit')
            ->eq(1)
            ->link();
        $this->assertEquals(
            $link->getUri(),'http://localhost:90/app_dev.php/ref/1/edit');

    }

}
