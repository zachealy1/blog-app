<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the Project

This is a Laravel-based blog application that allows users to register, log in, create posts, comment on posts, like
posts, and receive notifications for interactions on their content. Admin users can manage all users, posts, and
comments, while regular users can manage their own posts and comments.

This project leverages Laravel’s powerful features including:

- **Authentication and Authorization**: Supports user roles (admin and regular users).
- **Posts**: Users can create, edit, and delete posts.
- **Comments**: Users can add comments to posts.
- **Likes**: Users can like and unlike posts.
- **Notifications**: Users receive notifications when their posts are liked or commented on.
- **Admin Panel**: Admin users can manage users, posts, and comments.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Requirements](#requirements)
- [Usage](#usage)
- [Seeding](#seeding)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- User registration, login, and authentication.
- Post creation, editing, and deletion.
- Comments on posts.
- Like/unlike functionality for posts.
- Notifications for post likes and comments.
- Admin dashboard for managing users, posts, and comments.

## Installation

### Step 1: Clone the Project

Download the project ZIP file from the provided source.
Unzip the file into your desired directory.

```sh
git clone git@github.com:zachealy1/blog-app.git ~/development/repositories/blog-app
```

Navigate to the project directory in your terminal:

```sh
cd ~/development/blog-app
```

### Step 2: Install Dependencies

Install all PHP dependencies required by the Laravel project.

```sh
composer install
```

Install all JavaScript dependencies needed for asset management and frontend tooling.

```sh
npm install
```

Compile and bundle project assets like CSS and JavaScript for development use.

```sh
npm run dev
```

### Step 3: Migrate and Seed the Database

Migrate the database

```sh
php artisan migrate
```

Seed the database

```sh
php artisan db:seed
```

## Requirements

- PHP 8.1 or later
- Composer
- Node.js & NPM
- MySQL or another supported database

## Usage

Users can create, edit, and delete posts.
Users can add comments to posts.
Admins have access to an admin functions where they can manage posts and users.
Users receive notifications when their posts are liked or commented on.

## Admin Access

By default, an admin user is created during database seeding. You can log in using:

- Email: test@example.com
- Password: password

## Seeding

To generate fake data (users, posts, comments), run the following command:

```sh
php artisan db:seed
```

This will generate test users, posts, and comments. An admin user will also be created.

