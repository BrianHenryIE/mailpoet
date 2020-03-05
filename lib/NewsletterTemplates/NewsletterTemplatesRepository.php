<?php

namespace MailPoet\NewsletterTemplates;

use MailPoet\Doctrine\Repository;
use MailPoet\Entities\NewsletterTemplateEntity;

/**
 * @method NewsletterTemplateEntity[] findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null)
 * @method NewsletterTemplateEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsletterTemplateEntity|null findOneById(mixed $id)
 * @method void persist(NewsletterTemplateEntity $entity)
 * @method void remove(NewsletterTemplateEntity $entity)
 */
class NewsletterTemplatesRepository extends Repository {
  protected function getEntityClassName() {
    return NewsletterTemplateEntity::class;
  }

  /**
   * @return NewsletterTemplateEntity[]
   */
  public function findAllForListing(): array {
    return $this->doctrineRepository->createQueryBuilder('nt')
      ->select('PARTIAL nt.{id,categories,thumbnail,name,description,readonly}')
      ->addOrderBy('nt.readonly', 'ASC')
      ->addOrderBy('nt.createdAt', 'DESC')
      ->addOrderBy('nt.id', 'DESC')
      ->getQuery()
      ->getResult();
  }
}