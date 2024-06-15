<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        return response()->json([
            'success' => true,
            'results' => Category::all()
        ]);

    }

    //Funzione per filtrare per categorie
    public function category_filter(Request $request)
    {

        //Definisco un array vuoto di supporto
        $supp_collections_arr = [];

        //Se la stringa contiene la ',' vuol dire che ci sono almeno due elementi (Due categorie per cui filtrare)
        if (str_contains($request->category, ',')) {
            //Applico l'explode alla stringa che contiene le virgole
            $exploded_category_str= explode(',', $request->category);

            //Ciclo all'interno dell'array di Id risultante dall'explode
            foreach ($exploded_category_str as $id) {
                //Effettuo la query e pusho le due collections nell'array vuoto di supporto
                $cat = Category::find($id);
                array_push($supp_collections_arr, $cat->photos);
            }
            
            //Se ci sono almeno due collections definisco una nuova variabile che sarà l'intersezione delle due collection 
            if (count($supp_collections_arr) >= 2) {

                $inter = $supp_collections_arr[0]->intersect($supp_collections_arr[1]);

                //Nel caso ci siano più collection nell'array Applico il risultato dell'intersec() delle prime due collections con la nuova collection successiva. Con il ciclo for sono in grado di poter fare questa cosa per tutte le collections nell'array di supporto
                for ($i = 2; $i < (count($supp_collections_arr)); $i++) {

                    $inter = $inter->intersect($supp_collections_arr[$i]);

                }
            }

            return response()->json([

                'success' => true,
                //Richiamo $inter->all() per ottenere i risultati
                'results' => $inter->all()
            ]);

        }
        //Se la stringa non contiene la ',' vuol dire che non ci sono due elementi (Solo una categoria per cui filtrare) 
        //MI SONO OCCUPATO NEL CASO DOVE NON CI SIANO CATEGORIE DIRETTAMENTE SU VUE RICHIAMANDO TUTTE LE FOTO
        else {

            $category = Category::find($request->category);
            $photos = $category->photos;

            return response()->json([
                'success' => true,
                'results' => $photos
            ]);
        }
    }
}
