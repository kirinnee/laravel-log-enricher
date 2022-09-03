<?php

namespace Kirinnee\LaravelLogEnricher;

class RequestBodyProcessor
{
    /**
     * Adds additional request data to the log message.
     */
    public function __invoke($record)
    {
        if (config('laravel_log_enricher.log_request_data')) {
            $record['request']['inputs'] = request()->except(config('laravel_log_enricher.ignore_request_fields'));
        }

        if (config('laravel_log_enricher.log_request_headers')) {
            $record['request']['headers'] = request()->header();
        }

        if (config('laravel_log_enricher.log_session_data')) {
            $record['request']['session'] = session()->all();
        }
        return $record;
    }
}
