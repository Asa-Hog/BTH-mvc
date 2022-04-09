<!-- För att starta servern -->
php -S localhost:8888 -t public



<!-- För att fixa felen i src-mappen Lagt denna kod i composer så går att köra med nedanstående kommando--> 
<!-- tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src -->
<!-- För att rätta fel i koden - i src-mappen (php-filer)-->
composer csfix
