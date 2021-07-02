<?
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CatalogController{
    public function show(){
        $number = random_int(0,100);

        return new Response(
            '<h1>Каталог</h1>'
        );
    }
}
