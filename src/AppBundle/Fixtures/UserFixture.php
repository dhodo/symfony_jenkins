<?php

namespace AppBundle\Fixtures;

use AppBundle\Entity\Client;

class UserFixture
{
	private $em;

	public function __construct($em)
	{
		$this->em = $em;
	}

    public function createClientsFixture()
    {
        $client1 = new Client();
        $client1->setName('Client1')->setActive(1)->setDemo(0);
        $this->em->persist($client1);

        $this->em->flush();
    }

    public function createClients2Fixture()
    {
        $client1 = new Client();
        $client1->setName('Client2')->setActive(1)->setDemo(0);
        $this->em->persist($client1);

        $this->em->flush();
    }
}
