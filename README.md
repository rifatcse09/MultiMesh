# MultiMesh Microservices Project

This project implements a microservices architecture with a unified gateway, multiple services, and Kafka messaging. All components are containerized using Docker for easy orchestration.


## Prerequisites

- [Docker](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04) 
- [Docker Compose](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04)
  
  
## 🚀 Services Overview

| Service         | Tech     | Purpose                        |
|----------------|----------|--------------------------------|
| Gateway         | Node.js / Nginx | Routes external traffic to internal services |
| Service 1       | Laravel  | Business logic or API endpoint |
| Service 2       | Laravel  | Another backend component      |
| Service 3       | Node.js | Kafka message consumer         |
| Kafka           | Kafka    | Message broker between services|


## Installation

To install the application, follow the steps below:

1. Clone the repository:

   ```
   git clone https://github.com/rifatcse09/MultiMesh
   ```

2. Navigate to the cloned directory:

   ```
   cd MultiMesh
   ```

## 🐳 Docker Usage

### 🔧 Build and Start Services

```bash
docker-compose up --build

The installation script checks for the existence of `docker-compose.yml` and `.env` files, and copies them from the example files if they do not exist. It also clones the latest version of Laravel, sets file permissions, installs Laravel dependencies, generates an application key, and restarts the containers.

## Configuration

Before running the installation script, review the `.env` file to set the environment variables. You can use `nano .env` to open the file for editing.

## Usage

To start the containers, run the following command:

```
docker-compose up -d
```

The containers can be accessed at:

- Nginx: `[http://localhost/service1/api/v1/kafka/publish`](http://localhost/service1/api/v1/kafka/publish)
