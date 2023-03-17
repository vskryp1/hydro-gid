## CI/CD configuration

CI is configured by .gitlab-ci.yml and [GitLab CI/CD Variables](https://gitlab.com/jordanhammond/ticket-works-api/settings/ci_cd)

For setup CI/CD you need:
* add `.gitlab-ci.yml` to project root 
* setup [GitLab CI/CD Environment variables](https://gitlab.com/jordanhammond/ticket-works-api/settings/ci_cd)

## For add environment

* Uncomment job in `.gitlab-ci.yml`
* Add variables to [GitLab CI/CD Environment variables](https://gitlab.com/jordanhammond/ticket-works-api/settings/ci_cd)

![gitlab_ci_env](../images/gitlab_ci_env.png)

### Environment variables

|   development         |   staging                 |   production           |   example                    |
| --------------------- | ------------------------- | ---------------------- | ---------------------------- |
| DEV_DOMAIN            | STAGING_DOMAIN            | PROD_DOMAIN            | example.com                  |
| DEV_DOMAIN_URL        | STAGING_DOMAIN_URL        | PROD_DOMAIN_URL        | http://example.com           |
| DEV_ENV_VARIABLES     | STAGING_ENV_VARIABLES     | PROD_ENV_VARIABLES     | `cat .env | base64`          |
| DEV_SERVER_PATH       | STAGING_SERVER_PATH       | PROD_SERVER_PATH       | /home/user/dev.example.com   |
| DEV_SSH_HOST          | STAGING_SSH_HOST          | PROD_SSH_HOST          | 1.1.1.1                      |
| DEV_SSH_PORT          | STAGING_SSH_PORT          | PROD_SSH_PORT          | 2222                         |
| DEV_SSH_PRIVATE_KEY   | STAGING_SSH_PRIVATE_KEY   | PROD_SSH_PRIVATE_KEY   | `cat ~/.ssh/id_rsa`          |
| DEV_SSH_USER          | STAGING_SSH_USER          | PROD_SSH_USER          | user                         |

---

#### PROD_DOMAIN

Project domain name 
```
example.com
```

#### PROD_DOMAIN_URL

Project domain name with protocol
```
http://example.com
```

#### PROD_ENV_VARIABLES

File .env encoded with base64

```shell
# encoding
cat .env | base64

# decoding
base64 -d {{filename}}
```

You can use the service https://base64decode.org

**Example `.env`**

```conf
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:HqSU9nOyo9mZDTKiOpme/DavOMnIdvlpxKVHkb5p+HI=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=root
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```


**Encoded `.env` example**
```
QVBQX05BTUU9TGFyYXZlbApBUFBfRU5WPWxvY2FsCkFQUF9LRVk9YmFzZTY0OkhxU1U5bk95bzlt
WkRUS2lPcG1lL0Rhdk9NbklkdmxweEtWSGtiNXArSEk9CkFQUF9ERUJVRz10cnVlCkFQUF9VUkw9
aHR0cDovL2xvY2FsaG9zdAoKTE9HX0NIQU5ORUw9c3RhY2sKCkRCX0NPTk5FQ1RJT049bXlzcWwK
REJfSE9TVD1teXNxbApEQl9QT1JUPTMzMDYKREJfREFUQUJBU0U9aG9tZXN0ZWFkCkRCX1VTRVJO
QU1FPXJvb3QKREJfUEFTU1dPUkQ9c2VjcmV0CgpCUk9BRENBU1RfRFJJVkVSPWxvZwpDQUNIRV9E
UklWRVI9ZmlsZQpRVUVVRV9DT05ORUNUSU9OPXN5bmMKU0VTU0lPTl9EUklWRVI9ZmlsZQpTRVNT
SU9OX0xJRkVUSU1FPTEyMAoKUkVESVNfSE9TVD1yZWRpcwpSRURJU19QQVNTV09SRD1udWxsClJF
RElTX1BPUlQ9NjM3OQoKTUFJTF9EUklWRVI9c210cApNQUlMX0hPU1Q9c210cC5tYWlsdHJhcC5p
bwpNQUlMX1BPUlQ9MjUyNQpNQUlMX1VTRVJOQU1FPW51bGwKTUFJTF9QQVNTV09SRD1udWxsCk1B
SUxfRU5DUllQVElPTj1udWxsCgpQVVNIRVJfQVBQX0lEPQpQVVNIRVJfQVBQX0tFWT0KUFVTSEVS
X0FQUF9TRUNSRVQ9ClBVU0hFUl9BUFBfQ0xVU1RFUj1tdDEK
```

#### PROD_SERVER_PATH

Path to project in server

**Example**

```shell
/home/user/dev.example.com
```


#### PROD_SSH_HOST

Server IP adress or domain name

**Example**

```shell
# IP address
1.1.1.1

# Domain
example.com
```

#### PROD_SSH_PORT

Server SSH port

**Example**

```shell
# Standart
22

# Custom
2222
```

#### PROD_SSH_PRIVATE_KEY

Private SSH key

```shell
# get own ssh private key
cat ~/.ssh/id_rsa

# get project ssh private key 
cat ~/.ssh/project_name
```

**Example**

```key
-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCRfuvu8a+Eof7t54HGxe6FnB5VkK80cuGUYkwxzOh5QCKHDP/K
Lf5gxN92eDLeaM2b90eQ2MbLxDfk07msfuSdnsaHZbf6YZxGKE7Y7itciMyT800K
l+S1A+1en/gAWvvVg+UqKHc4hzCFCwk+eut1TXmC2UdkFt2HOAijYlX6hwIDAQAB
AoGBAIXycmUtzifuN9NwUfLcoGYTP34I0LQZm4HPKVSjz9Zo7CCnIApTY6BVP2FC
8Zn+pGQVOKaqXAKWZ9rb7VFYFUF/lkfgnjzuLwC2KCcMCgiLP7WhkRCt0AbWdBs/
SU8iK9NBWVxbKd4sIHBptoaaghg6fKoOyY/5f+pIRmqNh5YxAkEAyRUplxgAssm6
vo5jTJLPv/6O5fRCQwyXhrH+70oXJ0evi/u1pIgD4knKCGVkLzTlD/RBDP3DJpUK
8OqRMF4GnwJBALk7XPAQNU2s726eexqWmZWR2tZsOiDqaHxq4jgsFSLN2beV9o1I
85/yd/H3JS8kaB/vSWUvVOq72lkYovURixkCQHsCKiYW9d5pT4bgndgq+1HNDGeZ
q6tOmac5XeXOIinSTY5Jlc2nsxCL6T6Hn+jM58+BsQWcevQwOrg0FktLSasCQGwO
FDY6zk2Ev5wBOYEWL3wQPN/u/K3s8Iz78QGhvaay/PnaspxS3UQGNzBg40Ev9MoE
VgV/6gKRGVv2QkHCPSkCQCfdSo2zSW0J/EDGEc/+lLwqGgMSKt7qaUqeouX9fZtB
706yEHx9tgmKoSNWfOt0z3ID33eflhrCTM9k8zCy7uY=
-----END RSA PRIVATE KEY-----
```

#### PROD_SSH_USER

User for connect over ssh

**Example**

```shell
user
```
