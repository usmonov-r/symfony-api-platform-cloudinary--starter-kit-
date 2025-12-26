<div align="center">
    
# Symfony API Platform + Cloudinary Media Starter

A boilerplate for handling media (images, videos, documents) with **Symfony API Platform** and **Cloudinary**.
It uses Flysystem and VichUploader to keep file storage clean and flexible.

[![status](https://img.shields.io/badge/status-active-success)](#)

[![php](https://img.shields.io/badge/PHP-8.1%2B-FF6F00?logo=php&logoColor=white)](https://www.php.net/)
[![symfony](https://img.shields.io/badge/Symfony-6%2F7%2F8-EA1D25?logo=symfony&logoColor=white)](https://symfony.com/)

[![api-platform](https://img.shields.io/badge/API%20Platform-enabled-00B3A4?logo=api-platform&logoColor=white)](https://api-platform.com/)
[![vich-uploader](https://img.shields.io/badge/VichUploaderBundle-uploading-43A047)](https://github.com/dustin10/VichUploaderBundle)
[![flysystem-cloudinary](https://img.shields.io/badge/Flysystem%20Cloudinary-adapter-F57C00)](https://github.com/ThomasVantuycom/FlysystemCloudinary)

[![cloudinary](https://img.shields.io/badge/Cloudinary-media%20storage-3F4EF0?logo=cloudinary&logoColor=white)](https://cloudinary.com/)


</div>

## Features
- Decoupled storage via Flysystem (easy to switch to S3, GCP, etc.)
- MediaObject entity based on schema.org
- Automatic file naming to avoid collisions
- Docker-ready (PHP, Nginx, Database)

## Prerequisites
- Cloudinary account (free tier is enough)
- Docker & Docker Compose

## Quick Setup

### 1. Configure environment
```bash
cp .env.example .env
```

### Update Cloudinary credentials in .env:
```bash
CLOUD_NAME=your_cloud_name
API_KEY=your_api_key
API_SECRET=your_api_secret
```

### 2. Start containers
```bash
docker compose up -d
```
### 3. Install dependencies
```bash
docker compose exec php composer install
```

### 4. Initialize project
```bash
docker compose exec php bin/console ask:install
```

## How It Works

* VichUploader handles file uploads

* Flysystem abstracts storage

* Cloudinary adapter uploads files

* API returns direct Cloudinary URLs

## Test Cloudinary
```bash
docker compose exec php bin/console app:test-cloudinary
```
Checkout terminal
A test file should appear in your Cloudinary dashboard.

## Usage

* Open http://localhost:{nginx-port}/api
 (Swagger UI)

* Use POST /api/media_objects

* Upload a file (multipart/form-data)

* Response includes a Cloudinary contentUrl
