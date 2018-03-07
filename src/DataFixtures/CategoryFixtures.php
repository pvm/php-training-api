<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private function data()
    {
        return [
            [
                'name' => 'PHP Syntax',
                'description' => 'PHP Syntax Description'
            ]
        ];
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->data() as $data) {
            $category = new Category();
            $category
                ->setName($data['name'])
                ->setDescription($data['description']);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
