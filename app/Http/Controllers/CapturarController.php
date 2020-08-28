<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Artigo;


class CapturarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('capturar');
    }

    public function storecarros(Request $request){
        $dados = $request->all();
        $matches = array();
        $matchesImgs = array();
        $matchesTituloLink = array();
        $matchesListDados = array();
        $matchesPrecos = array();
        $dadosCarros = array();
        

        if(isset($dados['txtCapturar']) && !empty($dados['txtCapturar'])){
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.questmultimarcas.com.br/estoque?termo='.$dados['txtCapturar']);
            // SSL important
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $html = curl_exec($ch);
            curl_close($ch);


            if(preg_match_all('/<article class="card clearfix" id="\s*(.*)\s*">/', $html,$matches)){
                foreach($matches[1] as $item){
                    $dadosCarros[]['idcarro'] = $item;
                }
            }

            preg_match_all('/<div class="card__img">\s*<a href="\s*(.*)\s*">\s*< *img[^>]*src *= *["\']?([^"\']*)/i', $html,$matchesImgs);


            preg_match_all('/<h2 class="card__title ui-title-inner">\s*<a href="\s*(.*)\s*">\s*(.*)\s*<\/a><\/h2>/', $html,$matchesTituloLink);



            preg_match_all('/<span class="card-list__title">\s*(.*)\s*<\/span>\s*<span class="card-list__info">\s*(.*)\s*<\/span>/', $html,$matchesListDados);

            preg_match_all('/<span class="card__price-number">\s*(.*)\s*<\/span>/', $html,$matchesPrecos);



            $cont = 0;
            $countCarros = count($dadosCarros);

            
            for($i = 0; $i < $countCarros; $i++){

                $dadosCarros[$i]['idusuario'] = Auth::user()->id;
                $dadosCarros[$i]['img'] = $matchesImgs[2][$i];

                $dadosCarros[$i]['link'] = $matchesTituloLink[1][$i];
                $dadosCarros[$i]['nome_veiculo'] = $matchesTituloLink[2][$i];

                for($j = 0; $j < 6; $j++){

                    $info = explode(': ', $matchesListDados[1][$cont]);

                    $dadosCarros[$i][tirarAcentos($info[0])] = $matchesListDados[2][$cont];

                    unset($matchesListDados[1][$cont]);
                    unset($matchesListDados[2][$cont]);
                    $cont++;
                }

                $preco = explode('036; ', $matchesPrecos[1][$i]); //036 == código $ ou substr($matchesPrecos[1][$i], 13);
                $dadosCarros[$i]['preco'] = strip_tags($preco[1]);

                
            }

            foreach($dadosCarros as $carro){
                $newArtigo = Artigo::create($carro);
            }

            
            
             return response()->json(true);
            // return redirect()->route('home')->with('success', 'Captura Realizada com Sucesso!');
            // dd($matches);
        }

        return response()->json(false);
        // return redirect()->route('capturar')->with('error', 'Houve um erro ao realizar a captura');

    }

    public function destroy(Request $request, $id){

        $artigo = Artigo::findOrFail($id);

        if($artigo){
            $artigo->delete();
            return redirect()->route('home')->with('success', 'Artigo removido com sucesso!');
        }
            
        return redirect()->route('home')->with('error', 'Houve um erro ao deletar o artigo');
            
    }

}
