<?php

/*
 * This file is part of Monofony.
 *
 * (c) Monofony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Fixture\Factory;

use App\Entity\User\AdminUserInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserExampleFactory extends AbstractExampleFactory implements ExampleFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $adminUserFactory;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * AdminUserExampleFactory constructor.
     *
     * @param FactoryInterface $adminUserFactory
     */
    public function __construct(FactoryInterface $adminUserFactory)
    {
        $this->adminUserFactory = $adminUserFactory;

        $this->faker = \Faker\Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var AdminUserInterface $user */
        $user = $this->adminUserFactory->createNew();
        $user->setEmail($options['email']);
        $user->setUsername($options['username']);
        $user->setPlainPassword($options['password']);
        $user->setEnabled($options['enabled']);

        if (isset($options['first_name'])) {
            $user->setFirstName($options['first_name']);
        }
        if (isset($options['last_name'])) {
            $user->setLastName($options['last_name']);
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('email', function (Options $options) {
                return $this->faker->email;
            })
            ->setDefault('username', function (Options $options): string {
                return $this->faker->firstName.' '.$this->faker->lastName;
            })
            ->setDefault('enabled', true)
            ->setAllowedTypes('enabled', 'bool')
            ->setDefault('password', 'password')
            ->setDefault('api', false)
            ->setDefined('first_name')
            ->setDefined('last_name')
        ;
    }
}
