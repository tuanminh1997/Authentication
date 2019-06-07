<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends BaseFixture
{
    private static $articleTitles = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy',
    ];
    private static $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];
    private static $articleAuthors = [
        'Tuan Minh',
        'Minh Nguyen',
    ];
    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(Article::class,10,function (Article  $article,$count) use ($manager){
            $article->setTitle($this->faker->randomElement(self::$articleTitles))
                ->setContent('This is content');


            if ($this->faker->boolean(70)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100days','-1days'));
            }

            $article->setAuthor($this->faker->randomElement(self::$articleAuthors))
                ->setHeartCount($this->faker->numberBetween(5,100))
                ->setImageFilename($this->faker->randomElement(self::$articleImages));

        });
        $manager->flush();
    }
}
