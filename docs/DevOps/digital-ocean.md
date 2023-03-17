# Steps for add new server in DO:

## 1. Login to [digitalocean.com](https://digitalocean.com)
## 2. Select menu "Droplets"

![select-droplets](../images/select-droplets.png)

## 3. Create droplet

![create-droplet](../images/create-droplet.png)

## 4. Select OS Ubuntu 18.04 and instance type 

![create-droplet](../images/instance-type.png)

## 5. Scroll down this page and select datacentr

## 6. Enable monitoring

![select-zone](../images/select-zone.png)

## 7. Add you own ssh public key


![add-ssh](../images/add-ssh.png)


### 7.1 Get ssh public key

```shell
cat ~/.ssh/id_rsa.pub
```

### Example

```key
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAAAgQC82fwDlRpja21kWJzZ47Y1URzetjk5hN58vwmlFr/7NsFDqIr6Ry9L85zyTfWnr+8rPbJ7/FOYjYV43fUQtWUUZtBmaYSaZOx9tbSF0RTFxPHrrh0c/N+msVOmrKlgHtj9XJJwnKVCQ/q2g+07dqDyp3gkC2ohE4yMLp+7i8FSFQ== user@hostname
```

### 7.2 Add new ssh public key

![add-ssh-2](../images/add-ssh-2.png)

### 7.3 Enable all needed ssh keys

They will be added to the droplet.

![add-ssh-3](../images/add-ssh-3.png)

## 8. Set hostname and create instance

![change-hostname](../images/change-hostname.png)

## 9. In a few minutes a new droplet will be created.

![new-droplet.png](../images/new-droplet.png)

# Result

You have new droplet on Digital Ocean

|   |   |
| -------- | ---------------- |
| SSH USER | `root`           |
| SSH HOST | ip from `step 9` |
| SSH PORT | `22`             |

## Connect via SSH

```shell
ssh root@1.1.1.1
```