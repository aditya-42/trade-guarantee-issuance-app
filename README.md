# Trade Guarantee Issuance App


## Prerequisites

- Docker & Docker Compose installed on your machine.
- A text editor to modify the `.env` file for environment configuration.

## How to Run the App

Follow these steps to get the app up and running on your local machine:

### 1. Clone the Repository

Clone the repository to your local machine using the following command:

```bash
git clone <repository-url>
cd <repository-directory>
```

### 2. Copy the Example Environment File
```
cp .env.example .env
```

### 3. Change the environment variables to following

```
DB_CONNECTION=mysql
DB_HOST=mysql_db
DB_PORT=3306
DB_DATABASE=trade_db
DB_USERNAME=custom_user
DB_PASSWORD=custom_password
```

### 4.  Run Docker Compose
Use Docker Compose to start the application. This will automatically build and start the containers defined in the docker-compose.yml file.

Run the following command:

```bash
docker-compose up --build
```

### 5. Open following in browser

```bash
http://localhost:8000
```



