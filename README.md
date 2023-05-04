# Symfony basics

Just a demo project to show Symfony basic features.

## Brand new Symfony Project Installation
* Install Symfony cli:
  `brew install symfony-cli/tap/symfony-cli`
    * Reference: 	https://symfony.com/download

* Check requirements
  `symfony check:requirements`

* First Symfony project:
    * For Web Projects
      `symfony new {project-name} --webapp`

    * For commands, APIs, microservices:
      `symfony new my_project_directory`

      (The only difference is the packages which are installed by default)

    * Reference: https://symfony.com/doc/current/setup.html

## Installation of this project
1. Clone the repo
2. Install dependencies
    `composer install`

## Create a first Controller:

`$>symfony console make:controller`

There we only have to give the Controller name and it will create the ***Controller*** class and twig ***Template***. View [Commit](https://github.com/ipallares/symfony-basics/commit/b584c0aad8ec026e1169440648bd974bb6bb6d57).

## Configure the Database
To keep things simple we will be using a sqlite DB. See [commit](https://github.com/ipallares/symfony-basics/commit/6d2058fe350257dc17ca48fe8f97873d50130d8e)

## Create a Doctrine Entity
`$)symfony console make:entity`
The prompt will ask us for the properties we want for the Entity. As an example:

````
➜  symfony-basics git:(main) ✗ symfony console make:entity

 Class name of the entity to create or update (e.g. TinyKangaroo):
 > Todo

 created: src/Entity/Todo.php
 created: src/Repository/TodoRepository.php

 Entity generated! Now let's add some fields!
 You can always add more fields later manually or by re-running this command.
 
New property name (press <return> to stop adding fields):
 > name

 Field type (enter ? to see all types) [string]:
 >

 Field length [255]:
 >

 Can this field be null in the database (nullable) (yes/no) [no]:
 >

 updated: src/Entity/Todo.php

 Add another property? Enter the property name (or press <return> to stop adding fields):

 ````

Since we have the DB configured and a Doctrine Entity we can generate the migrations and push it all in a single commit.

`$)symfony console doctrine:migrations:diff`

Now we need to run the migration so our DB gets updated with the table for the `Todo` Entity:

`$)symfony console doctrine:migrations:migrate`

Code generated in this step can be seen [here](https://github.com/ipallares/symfony-basics/commit/9d79d10ab02fb02b46de2b04b873876009564be0)

## Use Doctrine Repository and show it in Frontend

First approach of a flux between the User, the Controller, the Database and back. Code can be seen [here](https://github.com/ipallares/symfony-basics/commit/c3c30f4da78063044d9f23569c2072a7729de622).
Disclaimer: Wrong approach, will be corrected in next commit

## Use Service classes
It is bad practice to connect directly Controllers to Persistence Layers (Repository). We will use an intermediate class, following naming convention `{entityName}Service`, in this case `TodoService`.
This intermediate class will be called by the proper input System (Controller, Command, other services...) and will access the DB.
In our particular example there is no business logic involved, but still we wanna keep the layer for consistency and maintainability purposes.
Changes can be seen [here](https://github.com/ipallares/symfony-basics/commit/887de9efa5a167e80eae4e55dbbcf49cd0e7a2ce).

## Dependency Inversion
As stated by the `D` in the `SOLID` Principles, we wanna depend on abstractions and not implementations (to be use with caution and common sense :) ). This principle is aimed at decoupling our code and make maintenance easier. In [this commit](https://github.com/ipallares/symfony-basics/commit/1efad39fde92d49ddf4e47cc59ff6b0da1bb7c1b) can be seen, how we inject an interface `TodoServiceInterface` instead of the `TodoService` class.

## Adding a new implementation for the Interface (Strategy Pattern)
Now we give a new implementation for the `TodoService` class, called `TodoCustomService` which basically gives a hardcoded list of Todos (so it is just for the purpose of showing its use and how Symfony helps there). Code can be seen [here](https://github.com/ipallares/symfony-basics/commit/b7335d531a08fefc6146cefd043e98271e33f142). We show also how to configure the service in the `services.yaml` file to tell the system which implementation (strategy) to use.

In a more realistic scenario we can think of an interface `UserProviderInterface`. Some of our customers will tell us to get the users from a DB, some others will give as a Rest API Endpoint, some others an LDAP Server, Keycloak... All we need to do is use UserProviderInterface as parameter Type in our methods and implement the classes for the different use case. The for every client we will configure the proper implementation to be used (see [how we configure it](https://github.com/ipallares/symfony-basics/commit/b7335d531a08fefc6146cefd043e98271e33f142#diff-c47b03734cd2b4337b345eeba955637ba790d51fd98979f6d366d4acbdb104e0R15))

## Create an endpoint
A new controller, with an api route to show the Todos in Json format is added. The code can be seen [here](https://github.com/ipallares/symfony-basics/commit/071be72c0ff72787cf8f535f9845580d3f653754).


## Create a Command to get Todos and export to some external service
We create a Command class using Symfony's maker:
`$)symfony console make:command`

The process is just like this:

````
➜  symfony-basics git:(development) symfony console make:command

 Choose a command name (e.g. app:tiny-kangaroo):
 > app:export-todos

 created: src/Command/ExportTodosCommand.php


  Success!


 Next: open your new command class and customize it!
 Find the documentation at https://symfony.com/doc/current/console.html
 ````

See the final code [here](https://github.com/ipallares/symfony-basics/commit/e2b0812bebf5ac8d464c2cb268a1239f6529ea3e).

Thinks to keep in mind:
* No business logic in the command
* Using interfaces instead of implementations

## Configurations

We can work with environment variables in our .env files. The naming convention for such files and their application is `.env[.{environment}][.local]`. If {environment} is empty we work with production environment, otherwise we have by default `dev` and `test` environments. In the `.local` files we store the secrets of the given environment (see official [docu](https://symfony.com/doc/current/configuration.html#configuration-environments)).

We also work with configuration parameters, which also allow us to distinguish environments (by using `_{env}` suffix). The main configuration file is `services.yaml` where, apart from our services we can define configuration parameters and bind them to parameters that we can inject to our methods (all about Symfony configurations [here](https://symfony.com/doc/current/configuration.html) ).

Check  [this commit](https://github.com/ipallares/symfony-basics/commit/eaf52be884d2d9969246f080fc5bac08fce0f285) to see it all in practice. 
