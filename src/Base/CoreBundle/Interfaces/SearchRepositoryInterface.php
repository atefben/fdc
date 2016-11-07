<?php

namespace Base\CoreBundle\Interfaces;

interface SearchRepositoryInterface
{
    public function findWithCustomQuery($_locale, $searchTerm, $range, $page);
}