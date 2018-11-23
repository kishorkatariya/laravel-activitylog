# Activity log inside your Laravel app

The kishor/activitylog package provides easy to use functions to log the activities of the users of your app. It can also automatically log model events. The Package stores all activity in the activity_log table.

## Documentation


## Installation

##### Note: This Activity Log Package working in laravel eloquent

You can install the package via composer:

``` bash
"repository":[
	{
		type:"vcs",
		url:"https://github.com/kishorkatariya/laravel-activitylog.git"
	}
]
"require": {
    "kishor/activity": "dev/master#1.*",
},
"autoload": {
    "psr-4": {
        "Kishor\\Activity\\": "src/"
    }
}
```

After Composer Update

```base
    composer update
```

Add the service provider to the config/app.php file in Laravel

Providers
```base    
    Kishor\Activity\ActivityServiceProvider::class,
```
Alias

```base                
    'Activity' => \Kishor\Activity\Facades\Activity::class,
```

The package will automatically register itself.

You can publish the migration with:
```bash
    php artisan vendor:publish

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

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

<!--- Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium. -->

<!--- We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).-->
