# Activity log inside your Laravel app

The kishor/activitylog package provides easy to use functions to log the activities of the users of your app. It can also automatically log model events. The Package stores all activity in the activity_log table.

## Documentation


## Installation

##### Note: This Activity Log Package working in laravel eloquent


You can install the package via composer:

``` bash
composer require kishor/activity
```

The package will automatically register itself.

You can publish the migration with:
```bash
php artisan vendor:publish --provider="Kishor\Activity\ActivityServiceProvider" --tag="migrations"

```

After publishing the migration you can create the `activity_log` table by running the migrations:

```bash
php artisan migrate
```

After register activity observer in your AppServiceProvider 

For Example your User model

```base
public function boot()
{
    \App\User::observe(ActivityObserver::class);     
}
```

You can customise your activity messages in description and Enabled/Disabled generate log 

 in your model create Array and Method like below example

```base
protected $activityLogData = [
    'enabled' => true, // NOTE:- true => log enabled, false => disabled, default log is true
    'create' => 'Created Successfully.',
    'update' => 'Updated Successfully.',
    'delete' => 'Deleted Successfully.'
];

public function getActivityLogData()
{
    return $this->activityLogData;
}

```

You can customise table name using ENV variable set in config file:

```base
    'table_name' => env('DB_TABLE', 'activity_log'),
```

You can optionally publish the config file with:
```bash
php artisan vendor:publish --provider="Kishor\Activity\ActivityServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    /*
     * If set to false, no activities will be saved to the database.
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),
    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,
    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    'default_log_name' => 'default',
    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the default Laravel auth driver.
     */
    'default_auth_driver' => null,
    /*
     * If set to true, the subject returns soft deleted models.
     */
    'subject_returns_soft_deleted_models' => false,
    /*
     * This model will be used to log activity.
     * It should be implements the Kishor\Activity\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     */

    'activity_model' => \Kishor\Activity\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */

    'table_name' => env('DB_TABLE', 'activity_log'),
];
```

## Changelog



## Upgrading



## Testing

``` bash
composer test
```

## Contributing


## Security



## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

<!--- Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium. -->

<!--- We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).-->

## Credits
<!---
- [Freek Van der Herten](https://github.com/freekmurze)
- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)
-->
## Support us
<!---
Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
-->