#Informations

## Lock mechanism

A lock is applied every time a user access a translation.
When a user tries to access an article, we check if a lock is active.
We check the role of each user and if a role matches the translation our user tries to access, we prevent the access.