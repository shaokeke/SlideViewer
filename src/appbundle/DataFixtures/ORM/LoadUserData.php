<?php

/*
 * Use it typing
 *
 * php app/console doctrine:fixtures:load
 *
 *
 *
 * Type
 *
 * php app/console doctrine:database:create
 *
 * to create database
 *
 *
 *
 * Type
 *
 * php app/console doctrine:schema:update --force
 *
 * to update database
 */

namespace AppBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Slide;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var EntityManager $manager */
        $manager = $this->container->get('doctrine')->getManager();

        for ($i = 0; $i < 20 ; $i++) { 
            /** @var Slide $slide */
            $slide = new Slide();
            $slide->setName('Slide ' . $i);
            $slide->setDescription('This is the slide n°' . $i);
            $slide->setDateCreation(new DateTime(date('Y-m-d H:i:s')));
            $slide->setNotes('Created from data fixtures');
            $manager->persist($slide);
        }

        $manager->flush();
    }
}
