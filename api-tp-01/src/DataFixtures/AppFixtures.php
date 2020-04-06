<?php

namespace App\DataFixtures;

use App\Article\Status;
use App\Entity\Article;
use App\Entity\Category;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use mysql_xdevapi\TableUpdate;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $category1 = new Category();
        $category1->setName("CAT1")
        ->setCreated(new DateTime());
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName("CAT2")
            ->setCreated(new DateTime());
        $manager->persist($category2);




        $article  = new Article();
        $article->setContent($faker->realText(555,5))
        ->setTitle($faker->realText(15,1))
        ->setTrending($faker->boolean())
        ->setStatus($status =  $faker->numberBetween(Status::NOT_PUBLISHED, Status::PUBLISHED))
        ->setCreated(new DateTime())
        ->setCategoryId($category1);

        if ($status === Status::PUBLISHED) {
            $article->setPublished(new DateTime);
        }
        else {
            $article->setPublished(null);
        }
        $manager->persist($article);



        $article2  = new Article();
        $article2->setContent($faker->realText(555,5))
            ->setTitle($faker->realText(15,1))
            ->setTrending($faker->boolean())
            ->setStatus($status =  $faker->numberBetween(Status::NOT_PUBLISHED, Status::PUBLISHED))
            ->setCreated(new DateTime())
            ->setCategoryId($category2);

        if ($status === Status::PUBLISHED) {
            $article2->setPublished(new DateTime);
        }
        else {
            $article2->setPublished(null);
        }
        $manager->persist($article2);



        $manager->flush();



    }
}
