# DevOps

These documents describe how to:
- Add new server
- Configure CI
- Add new envarioment to CD

---

## [Add new server on Digital Ocean](digital-ocean.md)

For add new server read document

[digital-ocean.md](digital-ocean.md)

### After that you have:

|          |                                    |
| -------- | ---------------------------------- |
| SSH USER | `root`                             |
| SSH HOST | ip from [step 9](digital-ocean.md) |
| SSH PORT | `22`                               |

---

## [Setup new server for Docker](server_setup.md)

### Ansible playbooks need for

- install required applications
- server configuration
- apply security recommendations

[server_setup.md](server_setup.md)

### After that you have:

- Installed docker and docker-compose
- Created user `{{ project-name }}` with sudo without password
- Changed SSH port to 53126, disabled password authorization, disable root authorization
- Firewall configured: allow 80, 443 and 53126 ports; deny other incoming ports
- Created dir for deploy
- Installed Traefik (Reverse proxy) with Let's Encrypt (for ssl support)

---

## [CI/CD Configuration](CI_CD.md)

### For Add new server to CI/CD read:

**[CI_CD.md](CI_CD.md)**

## How to change CI/CD configuration

Continuous Integration and continuous delivery are determined by the file **[.gitlab-ci.yml](../../.gitlab-ci.yml)**

This file should be placed at the root of the project.

### Example [gitlab-ci.yml.example](gitlab-ci.yml)


## Docker in CI/CD is described by `docker` folder

```shell
docker          # Docker deploy and local development files
├── ansible     # Ansible playbooks for server setup
│   ├── ...     # Ansible playbooks files
├── app         # Files for buildig php app docker container
│   ├── aliases # Short aliasses for bash in app docker container
│   ├── Dockerfile  # File describing php app environment
│   ├── etc
│   │   └── php     # Dir with php configs
│   │       ├── php-fpm.conf # PHP-FPM config
│   │       └── php.ini      # PHP config
│   ├── fpm-entrypoint.sh
│   ├── keep-alive.sh
│   └── scheduler.sh
├── init.sql    # DB for local development and tests
├── nginx       # Files for buildig nginx docker container
│   ├── Dockerfile # File describing nginx environment
│   ├── etc        # Dir with nginx configs
│   │   ├── errorpages.conf # Configuration custom error pages
│   │   ├── fastcgi_params  # Fastcgi configuration
│   │   ├── html
│   │   │   └── ... # Default nginx site
│   │   ├── html-errorpages # custom error pages
│   │   │   └── _error-pages
│   │   │       ├── ...
│   │   │       └── 5xx.html
│   │   └── nginx.conf # Nginx configuration
│   └── nginx-entrypoint.sh     # Nginx startup script
└── sources                 # Files for build production docker image
    ├── app-entrypoint.sh   # Custom startup script
    └── Dockerfile          # File describing production app
```
