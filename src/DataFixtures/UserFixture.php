<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder= $passwordEncoder;

    }
    public function loadData(ObjectManager $manager)
    {
/*            $this->createMany(User::class, 10, function(User $user,$count) use ($manager) {

                $user->setEmail(sprintf('minh%d@gmail.com', $count));
                $user->setFirstName($this->faker->firstName);
                $user->setRoles(['ROLE_USER']);
                $user->setPassword($this->passwordEncoder->encodePassword(
                    $user,
                    '123456'

                ));
                $apiToken1=new ApiToken($user);
                $apiToken2=new ApiToken($user);
                $manager->persist($apiToken1);
                $manager->persist($apiToken2);
            });
        $manager->flush();*/

        $this->createMany(User::class, 10, function(User $user,$i) use ($manager) {
            $user->setEmail(sprintf('minh%d@gmail.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setAgreeTerms();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                '123456'
            ));
            $apiToken1=new ApiToken($user);
            $apiToken2=new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);

        });

        $manager->flush();
    }
}
