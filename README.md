<!-- För att starta servern -->
php -S localhost:8888 -t public



<!-- För att fixa felen i src-mappen Lagt denna kod i composer så går att köra med nedanstående kommando--> 
<!-- tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src -->
<!-- För att rätta fel i koden - i src-mappen (php-filer)-->
composer csfix

<!-- PHPMD - PHP Mess Detector - jkör från roten av projektet-->
tools/phpmd/vendor/bin/phpmd src text phpmd.xml


<!--PHPStan - Find bugs before they reach production  -->
tools/phpstan/vendor/bin/phpstan analyse src

<!-- Try to validate your code on level 9 and then you can downsize the level to an acceptable one. -->
tools/phpstan/vendor/bin/phpstan analyse -l 9 src


<!-- PHP Copy/Paste Detector (PHPCPD) -->
<!-- execute the tool like this. -->
tools/phpcpd/vendor/bin/phpcpd src


<!-- Execute the tools like this. -->

composer phpmd
composer phpstan
composer phpcpd
composer lint
<!-- The command composer lint is intended to run all tools that do linting. It could be a good idea to also include phpcs to check your codestyle. -->