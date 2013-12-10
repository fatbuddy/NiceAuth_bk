
# NiceAuth for CakePHP 2.0 #

-------------------------------

NiceAuth is a plugin for CakePHP the allows for easy management of users and permissions using CakePHP's ACL and Auth Components.
This plugin is currently *very* alpha and I would not recommend it for production environments out of the box.

**Shell Access is required to setup NiceAuth**

> Demo available at http://niceauth.rsmartin.me

Please post your ideas, comments and issues on our github page so we can continue development.

### Installation ###

> Please read and follow each step to insure a successful installation.
> I highly recommend you use a fresh installation of cakephp to test out this plugin.
> Make sure your CakePHP installation is installed, viewable to the web and connected to your database.
> The home page of your installation will guide you in setting up CakePHP

**To use the password reset feature, you must setup your email config file.**
Navigate to app/Config and copy email.php.default to email.php. Change setting to meet your setup.

From terminal, navigate to your app/Plugin folder and clone the Git repo.

```
git clone http://github.com/rsmartin/NiceAuth.git
```

Next, we need to the following line to the end of our app/Config/bootstrap.php file to load our plugins

```php
CakePlugin::load('NiceAuth', array('routes' => true));
```

Now, create your AppController.php file in app/Controllers and insert the following:

```php
<?php

class AppController extends Controller {
	
	var $uses = array('User', 'Group', 'Acl');
	public $components = array(
		'Acl',
		'Session',
		'Auth' => array(
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
				),
			'authError' => 'You are not authorized to view that page',
			)
		);
		
	public function beforeFilter() {
		$this->Auth->authorize = array(
    	AuthComponent::ALL => array('actionPath' => 'controllers'),
    		'Actions'
			);
		}
  
	}

?>
```

Next, from terminal, navigate to your app folder (eg. cakephp/app). Enter:

	Console/cake nice_auth.nice_auth db_init

You will be asked four questions for setting up the database. Enter y and enter for each.
This will create the Acl, User and Group databases as well as setup your Aco's and a superadmin user.

**Take note of the admin username and password once the process completes**

You can now navigate to yoursite.com/dashboard and login with the login credentials given to you earlier

Lastly you must set your home page to allow it to be viewed. The quickest method is to copy the PagesController.php from cakephp/lib/Controller to cakephp/app/Controllers then add the following within the class

```php
public function beforeFilter() {
	$this->Auth->allow('*');
	}
```

#### NOTE ####

Every time you create a new controller or action, it must be added to the Acl Database.
You can do this by navigating to cakephp/app in terminal and entering:

```	
Console/cake nice_auth.nice_auth update
```

**All of the above steps must be completed before you can access your site**

For help with other tasks, go to /dashboard and click the help tab