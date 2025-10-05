<?php

declare(strict_types=1);

namespace App\Setup\Contracts;

interface ConfiguratorInterface
{
    /**
     * Configure the application based on user selections.
     */
    public function configure(array $selections): void;

    /**
     * Get the list of required packages for this configuration.
     *
     * @return array<string>
     */
    public function getRequiredPackages(): array;

    /**
     * Get the list of recommended packages for this configuration.
     *
     * @return array<string>
     */
    public function getRecommendedPackages(): array;

    /**
     * Get the list of optional packages for this configuration.
     *
     * @return array<string>
     */
    public function getOptionalPackages(): array;
}
