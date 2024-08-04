# Train Service Management System

## Objective
Develop a backend system using Laravel that supports 
<ul>
<li>managing train services,</li>
<li>stations,</li>
<li>user wallets</li>
<li>ticketing</li></ul>
This task is designed to evaluate the candidate's proficiency with backend development, scheduling mechanisms, user management, and wallet integration.

## Prerequisites
- Proficient in PHP, Laravel
- Experience with MySQL or any relational database
- Knowledge of JWT for authentication
- Familiarity with Laravel scheduling and queues
- Basic understanding of handling financial transactions
## Project Command Using: 
```bash
composer create-project laravel/laravel bdCallingProject
```
## API route is not enabled in laravel 11. enable the API using the following command:
```bash
php artisan install:api
```
## I will install jwt-auth composer package.
```bash
composer require php-open-source-saver/jwt-auth
# This command use publish the package config file:
php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"
# generate a secret key. This will add JWT config values on .env file:
php artisan jwt:secret
#[D9Dpg9sf1VuAeHmtRW52sQkr33N54umSEuCQjbernNKANTzSUXo7HGkHmmy1lbho]
```
## Project Setup

### Step 1: Clone the repository
```bash
git clone https://github.com/your-username/train-management-system.git
cd train-management-system
