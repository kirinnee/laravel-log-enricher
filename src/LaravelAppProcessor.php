<?php

namespace Kirinnee\LaravelLogEnricher;

class LaravelAppProcessor
{
    /**
     * Adds additional request data to the log message.
     */
    public function __invoke($record)
    {
        if (config('laravel_log_enricher.log_app_details')) {
            $record['laravel']['Application Details'] = [
                'Laravel Version' => app()::VERSION,
                'PHP Version' => phpversion(),
                'Config Cached' => app()->configurationIsCached() ? 'Yes' : 'No',
                'Route Cached' => app()->routesAreCached() ? 'Yes' : 'No',
            ];
        }
        return $record;
    }
}
