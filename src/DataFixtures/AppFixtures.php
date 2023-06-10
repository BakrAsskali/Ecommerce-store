<?php

namespace App\DataFixtures;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{
   private UserPasswordHasherInterface $hasher;


   public function __construct(UserPasswordHasherInterface $hasher){
    $this->hasher=$hasher;
   }
    public function load(ObjectManager $manager): void
    {
      $users = [];
      for ($i = 0; $i < 5; $i++) {
          $user = new User();
          $user->setFullName('Bakr ' . $i . $i)
              ->setPseudo('bakrasskali' . $i . $i)
              ->setEmail('bakrasskali' . $i . $i . '@gmail.com')
              ->setRoles(['ROLE_USER'])
              ->setPlainPassword('password');
          $users[] = $user;
          $manager->persist($user);
      }
      
      $products = [];
      for ($i = 0; $i < 10; $i++) {
          $product = new Product();
          $product->setName('iphone X number' . $i)
              ->setPrice(260 + $i * 5)
              ->setBrochureFilename('anato-finnstark-anato-finnstark-anato-finnstark-anato-finnstark-web-petit-4-6480a08e73375.jpg')
              ->setDescription('this is a testing description')
              ->setUser($users[1]); 
          $products[] = $product;
          $manager->persist($product);
      }
      for ($i = 0; $i < 10; $i++) {
        $category = new Category();
        $category->setName('category'. $i)->setUser($users[1]); 
        $manager->persist($category);
    }
           $manager->flush();
      
    }
}
