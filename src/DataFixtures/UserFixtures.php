<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture implements DependentFixtureInterface
{

    private $svgAvatarFactory;
    private $fileSystemHelper;
    private $uploadPath;
    private $passwordEncoder;

    public function __construct(SvgAvatarFactory $svgAvatarFactory, FileSystemHelper $fileSystemHelper, $uploadPath, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
        $this->uploadPath = $uploadPath;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 200; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setEmail($faker->email);
//            $user->setPassword(password_hash($faker->password, PASSWORD_DEFAULT));
            $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'));
            $user->setCity($faker->city);
            $user->setBirthdate(new \DateTime(rand(1930, 2000) . '-' . $faker->month . '-' . $faker->dayOfMonth));


            $promotions = $this->getReferences('Promotion');
            $promotions = $faker->randomElements($promotions, rand(1, 2));
//        $promo = $promotions[rand(0, count($promotions)-1)];
            foreach ($promotions as $promotion) {
                $user->addPromotion($promotion);
            }
//        $user->addPromotion($promo);
            $filename = $this->getAvatar();
            $user->setAvatar($filename);
            $manager->persist($user);
        }

        $admin = new User();
        $admin->setFirstname('Sofiane');
        $admin->setLastname('Khadir');
        $admin->setEmail('lestife@hotmail.fr');
        $passwordHashed = $this->passwordEncoder->encodePassword($admin, 'admin');
        $admin->setPassword($passwordHashed);
        $admin->setCity('Marseille');
        $admin->setBirthdate(new \DateTime('1990-01-17'));
        $admin->setAvatar($this->getAvatar(12,15));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }

        public function getAvatar() {
//            $svg = $this->svgAvatarFactory->getAvatar(12, 15);
//            $filename = sha1(uniqid(rand())) . '.svg';
//            $filePath = $this->uploadPath . '/' . SvgAvatarFactory::AVATAR_DIR . '/' . $filename;
//            $this->fileSystemHelper->write($filePath, $svg);
//            $user->setAvatar($filename);

            $svg = $this->svgAvatarFactory->getAvatar(12,15);
            $filename = sha1(uniqid(rand(),true)).'.svg';
            $filePath = $this->uploadPath. '/' . $this->svgAvatarFactory::AVATAR_DIR . '/' . $filename;
            $this->fileSystemHelper->write($filePath, $svg);
            return $filename;
        }


    public function getDependencies()
    {
        return [
            PromotionFixtures::class
        ];
    }
}
