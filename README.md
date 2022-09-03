# Laravel Log Enricher

Automatically adds contextual data into Laravel's logging.

This includes:

- Request Body
- Request Header
- Process ID
- Class, Method, Line and File of the line that was logged
- Laravel Information (Laravel version, PHP version)
- Session Information
- Memory Usage of the current thread

## Installation

1. Install the package

```
composer require kirinnee/laravel-log-enricher
```

2. Add this package's LogEnhancer class to the tap option of your log channel in **config/logging.php**:

```
'production_stack' => [
    'driver' => 'stack',
    'tap' => [Kirinnee\LaravelLogEnricher\LogEnricher::class],
    'channels' => ['daily', 'slack'],
],
```

3. Generate config file to control behaviour

```
php artisan vendor:publish --tag=laravel-log-enricher-config
```

It has following configurations:

| Setting                      | Description                                                                                                  | type    |
| ---------------------------- | ------------------------------------------------------------------------------------------------------------ | ------- |
| `request_details`            | Enrich with Details of the request itself                                                                    | `bool`  |
| `request_data`               | Enrich with Request Body                                                                                     | `bool`  |
| `request_header`             | Enrich with Request Headers                                                                                  | `bool`  |
| `session_data`               | Enrich with Session Data                                                                                     | `bool`  |
| `memory_usage`               | Enrich with the current thread's memory usage                                                                | `bool`  |
| `app_details`                | Enrich with Laravels' application details, such as Laravel version, PHP version, Config Cached, Route Cached | `bool`  |
| `log_file_class_method_line` | Enrich with the Log caller's file, line, class and method                                                    | `bool`  |
| `log_process_id`             | Enrich with the current process ID                                                                           | `bool`  |
| `ignore_input_fields`        | Fields to ignore in the request body (sensitivie fields). For example, passwords, etc                        | `array` |

## Author

- [**Kirinnee**](https://github.com/kirinnee)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
