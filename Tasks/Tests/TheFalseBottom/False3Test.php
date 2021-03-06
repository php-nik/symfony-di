<?php

namespace BankiruSchool\DI\Tasks\Tests\TheFalseBottom;

use BankiruSchool\DI\Common\Tests\TheFalseBottom\False3;
use BankiruSchool\DI\Common\Tracker\CachingTracker;
use BankiruSchool\DI\Common\Tracker\LoggingTracker;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class False3Test extends False3
{
    protected function configureContainer(ContainerBuilder $builder)
    {
        if ($builder->has('logger')) {
            $builder
                ->register('logging_tracker', LoggingTracker::class)
                ->addArgument(new Reference('logging_tracker.inner'))
                ->addArgument(new Reference('logger'))
                ->setDecoratedService('tracker', null, 2);
        }

        if ($builder->has('cache')) {
            $builder
                ->register('cashing_tracker', CachingTracker::class)
                ->addArgument(new Reference('cashing_tracker.inner'))
                ->addArgument(new Reference('cache'))
                ->setDecoratedService('tracker', null, 1);
        }
    }
}
