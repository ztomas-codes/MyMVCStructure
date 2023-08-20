# My MVC Framework

## Installation

Use the github clone 

```bash
git clone https://github.com/ztomas-codes/MyMVCStructure.git
docker-compose build
docker-compose up
```

## Tree
## Installation

Use the github clone 

```bash
git clone https://github.com/ztomas-codes/MyMVCStructure.git
docker-compose build
docker-compose up
```

## Config 
config is in src/core/config.php
```php
return [
    "database" =>
    [
        "host" => "db",
        "user" => "thomas",
        "pwd" => "password123",
        "dbName" => "mydb",
    ],
];
```

## Tree
```bash
├── docker-compose.yml
├── README.md
└── src
    ├── assets
    │   └── style.css
    ├── core
    │   ├── config.php                <=== CONFIG
    │   ├── Controllers
    │   │   ├── Controller.php
    │   │   ├── ErrorController.php
    │   │   ├── HomeController.php   <=== HOME CONTROLLER examp.: http://localhost/
    │   │   └── TestController.php   <=== TEST CONTROLLER examp.: http://localhost/test
    │   ├── Core.php
    │   ├── Database
    │   │   └── Database.php
    │   ├── index.php
    │   ├── Models
    │   │   ├── Model.php
    │   │   └── User.php
    │   └── Views
    │       ├── Error
    │       │   └── IndexView.php
    │       ├── Home
    │       │   ├── IndexView.php
    │       │   └── WhereView.php
    │       ├── Template
    │       │   ├── footer.php
    │       │   └── header.php
    │       └── View.php
    └── Dockerfile
```

## Usage

### How is url constructed
```bash
http://localhost/{Controller}/{MethodInController}/{Params spliced by /}
```
Then it will fetch view by Controller name and Method name for example when i have url like this: 

```bash
http://localhost/home/whereis/LordMefloun
```
```php
namespace Controllers;
use Views\View;


class HomeController extends Controller
{
    public function index($params)
    {
        $view = new View("index", $this);
        $view->setData("user", $this->getDb()->getModelById(1, "Models\\User"));
        $view->render();
    }

    public function whereis($params)
    {
        $view = new View("where", $this);
        $view->setData("user", $this->getDb()->getModelByParam(["username" => $params[0]], "Models\\User"));
        $view->render();
    }
}
```
this will 
1. get view WhereView.php from this 
```bash
├── docker-compose.yml
├── README.md
└── src
    ├── assets
    ├── core
    │   └── Views
    │       ├── Home
    │       │   ├── IndexView.php
    │       │   └── WhereView.php
```
2. set variable ,,user'' in view WhereView.php to Model object User fetched by username in first param (LordMefloun)
3. Render view

WhereView.php
```php
<div>
    <h1>Home</h1>
    <p>Hi ! user is : <?php echo $user->username?> and he is <?php echo $user->id ?>.</p>
</div>
```


### How Model works
#### Creating model
Model is added in 
```bash
├── docker-compose.yml
├── README.md
└── src
    ├── assets
    ├── core
    │   ├── config.php 
    │   ├── Controllers
    │   ├── Core.php
    │   ├── Database
    │   ├── index.php
    │   ├── Models# My MVC Framework
Foobar is a Python library for dealing with word pluralization.

    public $tableName = "users";
    public $id;
    public $username;
    public $password;
}
```

But you need to create tables manually !! (Automatic creating not implemented yet)
to add Model into table in database :
```php
namespace Controllers;
use Models\User;

class TestController extends Controller
{
    public function newUser($params)
    {
        $user = new User();
        $user->username = $params[0];
        $user->password = "test";
        $this->getDb()->save($user);
    }
}
```
```bash
http://localhost/test/newuser/LordMefloun
```
will add "LordMefloun" user with password "test" into table "users"


### Change footer and header 
```bash
├── docker-compose.yml
├── README.md
└── src
    ├── assets
    ├── core
    │   └── Views
    │       ├── Error
    │       │   └── IndexView.php
    │       ├── Home
    │       │   ├── IndexView.php
    │       │   └── WhereView.php
    │       ├── Template
    │       │   ├── footer.php <== HERE
    │       │   └── header.php <== HERE
    │       └── View.php
```

### Form Factory in coming