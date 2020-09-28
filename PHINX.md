SeeFox
=====

The SeeFox  is a personnal framework for Akuren group  needs

## More resources:

##### ***how to use Phinx Console Command :***



* Create migration
````console
vendor/bin/phinx create CreateHomeTable
``````
* Create seeds
````console
vendor/bin/phinx seed:create HomeSeeder
``````

* Do Migrate

````console
vendor/bin/phinx migrate
``````

* Do Seed

````console
vendor/bin/phinx seed:run
``````