<?php

namespace Kirinnee\LaravelLogEnricher;

use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;

class LogEnricher
{
    /**
     * Customize the given logger instance.
     *
     * @param \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            if (config('laravel_log_enricher.log_request_details')) {
                $handler->pushProcessor(new WebProcessor());
            }

            if (config('laravel_log_enricher.log_memory_usage')) {
                $handler->pushProcessor(new MemoryUsageProcessor());
            }
            if (config('laravel_log_enricher.log_file_class_method_line')) {
                $handler->pushProcessor(new IntrospectionProcessor(0, [], 4));
            }
            if (config('laravel_log_enricher.log_process_id')) {
                $handler->pushProcessor(new ProcessIdProcessor());
            }
            $handler->pushProcessor(new RequestBodyProcessor());
            $handler->pushProcessor(new LaravelAppProcessor());
        }
    }
}
