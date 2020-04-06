<?php

namespace App\EventSubscriber;

use App\Article\Status;
use App\Entity\Article;
use App\Entity\Category;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityCreatedSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist, Events::preUpdate
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof Article || $object instanceof Category) {
            $object->setCreated(new DateTime());

        }
        if ($object instanceof Article) {
            $object->setStatus(1);
        }

    }
    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof Article) {
            if ($object->getStatus() === Status::PUBLISHED) {


                $object->setPublished(new DateTime());
            }
        }
    }
}