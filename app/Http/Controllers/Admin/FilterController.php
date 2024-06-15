<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function category_filter(Request $request)
    {
        //Definisco un array vuoto di supporto
        $supp_collections_arr = [];
       
        //Se la request contiene delle 'categories' allora itero nell'array per poi pushare ogni collection nell'array di supporto
        if ($request->has('categories')) {

            foreach ($request->categories as $category_id) {
                $category = Category::find($category_id);
                array_push($supp_collections_arr, $category->photos);
            }
            //Se ci sono due o più collections generate posso adottare l'intersec
            if (count($supp_collections_arr) >= 2) {

                $photos = $supp_collections_arr[0]->intersect($supp_collections_arr[1]);

                //Nel caso ci siano più collection nell'array Applico il risultato dell'intersec() delle prime due collections con la nuova collection successiva. Con il ciclo for sono in grado di poter fare questa cosa per tutte le collections nell'array di supporto
                for ($i = 2; $i < (count($supp_collections_arr)); $i++) {

                    $photos = $photos->intersect($supp_collections_arr[$i]);
                }

            } 
            //Se c'è solo una collection prendo direttamente quell'elemento dell'array e ne sfrutto il metodo photos() proprio del modello categories
            else {
               
                $category = Category::find($request->categories[0]);
                $photos = $category->photos;

            }
        //Nel caso non vi siano categories nella request, rimetto in pagina tutte le foto
        } else {

            $photos = Photo::orderByDesc('id')->get();
        }

        //Non essendo possibile passare 'photos' con compact, utilizzo la session
        session()->flash('photos', $photos);

        //Utilizzo lo stesso metodo per tenere in memoria le checkbox checkate
        $checks = $request->categories;
        session()->flash('checks', $checks);
        //Applico il redirect direttamente sulla pagina principale
        return to_route('admin.photos.index');
    }
}
