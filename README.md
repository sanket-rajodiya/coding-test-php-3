## Get Started

This guide will walk you through the steps needed to get this project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

- Docker
- Docker Compose

### Building the Docker Environment

Build and start the containers:

```
docker-compose up -d --build
```

### Installing Dependencies

```
docker-compose exec app sh
composer install
```

### Database Setup

Set up the database:

```
bin/cake migrations migrate
```

### Accessing the Application

The application should now be accessible at http://localhost:34251

## How to check

### Authentication

Login

![login](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/111d37e5-3e21-41fc-aff3-5ab432e3303d)

Logout

![logout](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/55648235-1c92-43b8-b6b2-dba36d7103a1)

### Article Management

View Single Article

![single-article](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/e8ca9f96-edff-4d59-8d92-43f49e45bfe4)

View all articles

![all-articles](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/f545aa2f-523a-409c-aaa4-41a32cd0b8bf)

Delete Article

![delete](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/4920beb2-2d62-4336-af80-283105d21030)

Add Article

![add-article](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/61a6ed38-893d-4784-86fb-2096a8f64654)

Edit Article

![edit](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/6f93fbc1-9593-4c4e-9095-964e8960c562)

### Like Feature

Like An Article

![Add-like](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/003a2c9b-c7f8-4ae3-ad22-1a4463745ae4)

Already Liked

![already-liked](https://github.com/sanket-rajodiya/coding-test-php/assets/128152862/47291567-944f-415e-8f6a-b0cd342fbe0b)


