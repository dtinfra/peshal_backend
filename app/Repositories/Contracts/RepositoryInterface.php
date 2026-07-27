<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * Get all records.
     */
    public function all();

    /**
     * Find a record by its slug.
     */
    public function findBySlug(string $slug);
}
