# symfony_issue_46219
reproducer for https://github.com/symfony/symfony/issues/46219

# How to install:
- git clone git clone https://github.com/Shoplifter/symfony_issue_46219
- cd into installation driectory
- composer install
- ceate .env.local with your DATABASE_URL    
  like: ````DATABASE_URL="mysql://user:password@127.0.0.1:3306/Symfony_Issue_46219?serverVersion=80&charset=utf8mb4"````
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force
- yarn install
- yarn build

# How to reproduce
- fill the form at the home page
- save (that still works)
- save again - Error
