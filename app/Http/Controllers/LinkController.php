<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;	/*o controlador utilizara o modelo Link*/
use App\Categoria;  /*o controlador utilizara o modelo Categoria*/
use Illuminate\Support\Facades\DB;	/*para trabalhar com o DB*/

class LinkController extends Controller
{
	public function index($categoria = null){
        if($categoria == null){  /*se não foi enviada uma categoria*/
		    $links = DB::table('links')->latest()->get(); 
        }else{  /*foi selecionada uma categoria*/
            $links = DB::table('links')->where('categoria_id', $categoria)->latest()->get();
        }
    	$categorias = DB::table('categorias')->orderBy('titulo', 'asc')->get();

      	return view('home', ['links' => $links, 'categorias' => $categorias]);
      	// chamando a view home e enviando os links e categorias a serem exibidos nela
	}	

    public function adicionar(){
        $categorias = DB::table('categorias')->orderBy('titulo', 'asc')->get(); /*recebendo todas as categorias ordenadad pelo titulo*/        
    	return view('criar')->with('categorias', $categorias);
    }

    public function salvar(Request $request){
        if(isset($request->categoriaNova)){
        	// validações com nova categoria
        	$this->validate($request, [
        		'descricao' => 'required|max:255',
        		'url' => 'required|max:255',
                'categoriaNova' => 'required|max:255'
                // 'categoria' => 'required_without_all:categoria'
        	]);

            $categoria = new Categoria();
            $categoria->titulo = $request->categoriaNova;
            $categoria->save();

            $categoriaId = $categoria->id;  /*guardando o id da categoria criada*/
        }else{
            // validações com categoria existente
            $this->validate($request, [
                'descricao' => 'required|max:255',
                'url' => 'required|max:255',
                'categoria' => 'required|Integer'
                // 'categoria' => 'required_without_all:categoriaNova'
            ]);    

            $categoriaId = $request->categoria;
        }

    	// recebendo os dados
    	$link = new Link();
    	$link->descricao = $request->descricao;
    	$link->url = $request->url; 
        $link->categoria_id = $categoriaId;
    	// recebendo os dados  
    	$link->save();	/*salvando o link criado no BD*/
    	
    	return redirect()->route('home');  /*redirecionando à pagina inicial = return redirect('/');*/ 	
    }	

    public function deletar($id){
    	$link = Link::find($id);
    	$link->delete();	/*deletando do banco de dados*/

    	return redirect()->route('home');  /*redirecionando à pagina inicial = return redirect('/');*/      
    }	

    public function editar($linkId){
        $categorias = DB::table('categorias')->orderBy('titulo', 'asc')->get(); /*recebendo todas as categorias ordenadad pelo titulo*/
        $link = Link::find($linkId);    /*recebendo o link a ser editado*/

        return view('editar', ['link' => $link, 'categorias' => $categorias]);
        // forma de enviar mais de um array para a view
    }    

    public function atualizar(Request $request, $linkId){
        if(isset($request->categoriaNova)){
            // validações com nova categoria
            $this->validate($request, [
                'descricao' => 'required|max:255',
                'url' => 'required|max:255',
                'categoriaNova' => 'required|max:255'
                // 'categoria' => 'required_without_all:categoria'
            ]);

            $categoria = new Categoria();
            $categoria->titulo = $request->categoriaNova;
            $categoria->save();

            $categoriaId = $categoria->id;  /*guardando o id da categoria criada*/
        }else{
            // validações com categoria existente
            $this->validate($request, [
                'descricao' => 'required|max:255',
                'url' => 'required|max:255',
                'categoria' => 'required|Integer'
                // 'categoria' => 'required_without_all:categoriaNova'
            ]); 
            
            $categoriaId = $request->categoria;
        }

        // atualizando os dados
        Link::find($linkId)->update($request->all());

        return redirect()->route('home');  /*redirecionando à pagina inicial = return redirect('/');*/
    }    
}
