## Gitflow

#### Definitions

- CRP - Code Review Person, developer who review code before it pass to staging.
- CR - Code Review, CRP action that confirms the compliance of the code with the project standards
- CI - program which performs Continuous Integration algorithm (build application, run unit tests, check code style, etc)
- MR - Merge Request, developer action when he tries to 


#### Branches
- master
- staging
- dev
- feature


### master

Related to production server. Contains the most stable code 

### staging

Related with staging server, configured same as production. QA test and approve MR to **master**

### dev

Dev branch exists for one reason - collect features branch in one place. 

All code in dev branch need to be tested (by automatic CI) and reviewed (by CRP), in order that described.

If CI fail test developer should fix bugs and update MR

When CR done successfull CRP, 

### feature

Feature branch related to JIRA task, created by developer for implementation specific functionality described in Jira task.

When task is done it should be merged with **dev** branch with merge request

Feature branch named as Jira task which functionallity implemented by (for example TW-123)

#### Flow

Feature -> Dev -> Staging -> Master