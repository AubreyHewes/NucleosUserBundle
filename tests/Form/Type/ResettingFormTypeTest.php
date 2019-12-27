<?php

declare(strict_types=1);

/*
 * This file is part of the NucleosUserBundle package.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\UserBundle\Tests\Form\Type;

use Nucleos\UserBundle\Form\Model\Resetting;
use Nucleos\UserBundle\Form\Type\ResettingFormType;

final class ResettingFormTypeTest extends ValidatorExtensionTypeTestCase
{
    public function testSubmit(): void
    {
        $model = new Resetting();

        $form     = $this->factory->create(ResettingFormType::class, $model);
        $formData = [
            'plainPassword' => [
                'first'  => 'test',
                'second' => 'test',
            ],
        ];
        $form->submit($formData);

        static::assertTrue($form->isSynchronized());
        static::assertSame($model, $form->getData());
        static::assertSame('test', $model->getPlainPassword());
    }

    protected function getTypes(): array
    {
        return array_merge(parent::getTypes(), [
            new ResettingFormType(Resetting::class),
        ]);
    }
}
