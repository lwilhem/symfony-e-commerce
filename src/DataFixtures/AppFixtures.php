<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 50; $i++)
        {
            $user = new User();
            $user->setEmail('test' . $i . '@gmail.com');
            $user->setUsername('User#' . $i);
            $user->setRoles([
                'ROLE_USER',
                'ROLE_ADMIN',
            ]);
            $password = $this->passwordHasher->hashPassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);
        }

        $manager->flush();

        $categoryList = ['Jeans', 'Jogging', 'T-Shirt', 'Sweatshirt', 'Shoes',
            'Pull', 'Shirt', 'Scarf', 'Socks', 'Jacket'];

        foreach($categoryList as $categories)
        {
            $category = new ProductCategory();
            $category->setName($categories);

            for($g = 1; $g <= 20; $g++)
            {
                $product = new Product();
                $product->setName('Product #' . $g);
                $product->setDescription('This is a Description for Product #' .$g);
                $product->setPrice(rand(3000, 4000));
                $product->setStock(random_int(20, 300));
                $product->setCategory($category);

                $manager->persist($product);
            }
            $manager->persist($category);
        }

        $manager->flush();
    }
}
