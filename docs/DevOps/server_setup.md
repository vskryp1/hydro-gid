
## Ansible server setup for docker

For setup new server use Ansible playbooks from dir
`docker/ansible`

### 1. Install ansible

```bash
sudo apt install -y ansible
```

### 2. Install playbook requirements

```bash
cd docker/ansible
ansible-galaxy install -r requirements.yml
```

### 3. Setup hosts.ini
```bash
cp hosts.ini.examlpe hosts.ini
nano hosts.ini
```

```ini
[docker]                    # host group
dev.example.com             # server name
ansible_host=1.1.1.1        # ip for ssh connection
ansible_ssh_user=username   # user for ssh
ansible_port=22             # port ssh
project_name=some-project   # variable fot set name for ssh keys, new sudo user and etc...
domain=dev.example.com      # for traefik config
```

### 4. Run server setup

```bash
ansible-playbook ansible-playbook.yml
```

#### Result

* Installed docker and docker-compose
* Created user `{{ project-name }}` with sudo without password
* Changed SSH port to 53126, disabled password authorization, disable root authorization
* Configured firewall: allow 80, 443 and 53126 ports; deny other incoming


### 5. Update `hosts.ini`

```shell
nano hosts.ini
```

#### Need change:

* `ansible_ssh_user` from `username` to `some-project`
* `ansible_port` from `22` to `53126`

```ini
[docker]                    # host group
dev.example.com             # server name
ansible_host=1.1.1.1        # ip for ssh connection
ansible_ssh_user=some-project   # change to project name
ansible_port=53126             # port ssh
project_name=some-project   # variable fot set name for ssh keys, new sudo user and etc...
domain=dev.example.com      # for traefik config
```

### 6. Run base setup

```shell
ansible-playbook base-setup.yml
```

#### Result

* Created dir for deploy
* Installed Traefik (Reverse proxy) with Let's Encrypt

### 7. Done

#### For connect to server use:

```bash
ssh -p 53126 project-name@1.1.1.1
```