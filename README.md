# <h2 style="text-align:center">Train Service Management System</h2>
<table>
<thead>
<tr>
<th>Objective</th>
<th>Prerequisites</th>
</tr>
</thead>
<tbody>
<tr>
<td>Managing train services,</td>
<td>Proficient in PHP, Laravel</td>
</tr>
<tr>
<td>Stations</td>
<td>Experience with MySQL or any relational database</td>
</tr>
<tr>
<td>user wallets</td>
<td>Knowledge of JWT for authentication</td>
</tr>
<tr>
<td>ticketing</td>
<td>Basic understanding of handling financial transactions</td>
</tr>
</tbody>
</table>

# <h2 style="text-align:center; color:lightgreen">Project Setup</h2>

### Step 1: Clone the repository
```bash
git clone https://github.com/MdThoratIslam/TrainServiceManagement.git
cd TrainServiceManagement
```
## Step 2: .env File Create and Copy Below Code and past your .env file

```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:UwM5PwVSi7WVv6sO/9ibF5UCgSYi5CCdDRnPf6H36Bk=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_bdCalling
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"

JWT_SECRET=D9Dpg9sf1VuAeHmtRW52sQkr33N54umSEuCQjbernNKANTzSUXo7HGkHmmy1lbho

JWT_ALGO=HS256
```

## Step 3: Composer Install
```bash
composer install
```

## Step 4: Create Database in MySQL
Open the Command Prompt (cmd) and log in to MySQL using the command:
```bash
mysql -u root -p
```
After logging in, create the database with the following command:
```bash
CREATE DATABASE db_bdCalling;
```
To verify that the database has been created, you can list all databases using:
```bash
SHOW DATABASES;
```

## Step 5: Migration
Once you have created the database, the next step is to run migrations to set up the database schema. This will create the necessary tables and structures in the database.
1. **Navigate to your project directory**:
   Open the Command Prompt (cmd) and navigate to the root directory of your project.
   ```bash
   php artisan migrate
   ```

## Step 6: Using Postman Collection

After setting up the database and running migrations, you can use Postman to interact with your API. Follow these steps to import and use the Postman collection:

1. **Open Postman documenter**:
   Launch Postman on your computer. you can documenter it from [here](https://documenter.getpostman.com/view/17894341/2sA3rwNEhD).

### Example

Here is an example of how to set up and run a request:

1. **Import Collection**: Import the provided `bdCalling.postman_collection.json` file.
2. **Set Environment Variables**: Ensure the environment variable `{{url_api}}` is set to your API's base URL (e.g., `http://localhost:8000/api`).

