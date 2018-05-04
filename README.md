# H-PHP-JSON-SQL-Statement
PHP Connect multiple database from outside server via JSON-HTTP. This small API will work as a bridge between a PHP server to another PHP server. If you thinking to connect your current server to another Database Server (MySQL etc.), then this is an alternative.

This connection between server to server implements REST JSON Weservice (on HTTP). From the client, the data will be wrap as JSON and send as POST Body to HJS_Server, then the server will return the JSON structured data.

The HJS Server implements PDO connection which is developer can change their database driver as they need as well.


# HOW-TO INTALL HJS?
**Server Setup**
1. Copy the `HJS_Server` folder to your website e.g.: `/public_html/HJS_server`. Make sure the path is reachable on public as: `https://your-website.com/HJS_Server/`
2. Change the security key. Go to `HJS_server/setup/config.php` and change the key to you own key.
3. Set default database connect (*this is optional*). Go to `HJS_Server/core/config.php` and update your database connection information.

Please make sure you put your key in the second step **if you set the default database**. Refusing to use the key when you set default database will enable attacker to access your database easily. 
*You may ignore the third step if you want to set the database connection from the client server*

**Client Setup**
1. Copy the folder `HJS_Client` to your `classes/` folder and rename the `HJS_Client` folder to `HJS`. E.g.: `public_html/classes/HJS/`.
2. Set the key. Go to `HJS/HSJ_CONFIG.php` and put your HJS Server information. URL and key are required. You may ignore all database connection information if you have set the default connection in the server configuration. The key mus be the same as the set that set in the server. If you have other database server to connect, then just put the database information above and make sure that server has to be install `HJS_Server` too.
3. Set header request (*this is optional*). If you set the .htaccess and .htpasswd in the `HJS_Server/` folder, then you may define the authorization maybe something like `Basic username:password` or `OAuth somewierdkeygoeshere`. Plus, you may set the custom header also in `array()` like `array("Content-Type: application/json", "Authorization: Basic base64_encode(username:password)")` as well.

*The HJS API could work witout step three :P*
Now you are good to go.

# START USING HJS
After all step has been set up, then your server is now connected to the outside database server. Here's some feature you may start with. All return data will be in `object`. Before you start, make sure that every `.php` file that you want to use `HJS` must be load the `autoload` file.

e.g.: `include_once("vendor/__autoload.php")`

**1. Basic Querying**
```
use HJS\HJS;
$x = HJS::req()->query("SELECT * FROM users");
echo print_r($x);
```
The above code will run the SQL command to you **first database in you HJS_CONFIG.php**. In the `req()` method, you may pass the database index number in you `HJS_CONFIG.php` file. As an example, I have 3 database listed in `HJS_CONFIG.php` file, and I want to run the query at the second database server. Here's how it can be done:
```
use HJS\HJS;
$x = HJS::req(1)->query("SELECT * FROM users");
echo print_r($x);
```

Or other way, you want to connect to the database which is not listed in the list, then you may pass the database connection information in `array()` format. As exmaple:
```
use HJS\HJS;

$connection = array(
  "url" => "https://someurl.com/HJS_server/", //This is required information
  "key" => "somekeythatinstalledinHJS_Server", // This is also required information
  "database" => "", //This is optional
  "username" => "", //This is optional
  "password" => "", //This is optional
  "host"     => "" //This is optional
);

$x = HJS::req($connection)->query("SELECT * FROM users");
echo print_r($x);
```
The optional information above is not required when if you have set the default database connection in `HJS_Server/` config file.

**2. Binding Data**
As I said before, this API Classes rely on `PDO` database driver and it support data binding for it security. So below I will show you how to implement the data binding in `HJS`.

```
user HJS\HJS;

$x = HJS::req()->query("SELECT * FROM users WHERE u_id = ?", array("u_id" => '1'));
echo print_r($x);
```
The binded data must be wrap into an `array()` and pass to the second parameter on `query()` method.

**3. Update Data**
This method is only optional uses. You may achieve this result using `query()` method as well.

Consider you want to edit the `u_name` to some value in `users` table which the `u_id = 10`. Here's some example:

```
use HJS\HJS:
$data = array(
  "u_name" => 'try'
);
$x = HJS::req()->update("users", "u_id = 10", $data); //return data as boolean
echo print_r((bool)$x);
```
The `update()` method are not so secured enough so far because the SQL can be injected vai the second parameter `u_id = 10` as the value of 10 is not binded as well. But I ll figure it out on next update.

**4. Insert Data**
This method also only optional uses. You may achieve this result using `query()` method as well.

Consider I want to insert a new `users`. Here's some example:
```
use HJS\HJS;
$data = array(
  "u_name"  => 'Master Hery',
  "u_login" => 'mrhery'
);
$x = HJS::req()->insert("users", $data); //return data as boolen
echo print_r((bool)$x);
```

# Security Matter
I am not an expert in security but most of security experts advice that every HTTP transaction has to be done under secured line. Simple word: use `HTTPS` instead of `HTTP`.

# Future Planning
In future update, I will implement data enryption which is all send and received data will be encrypted rely on AES-PHPSecLib for upgrading security matter.

# Problem?
Contact me at here. Here. Yes Here. At GitHub :)
