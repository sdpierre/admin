<?php

namespace Modules\Article\Http\Controllers;

use App\Article;
use App\User;
use App\Category;
use App\SubCategory;
use Auth;
use App\UsersGroups;
use App\MediaArticle;
use App\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $articles = [];

        $datepublication = (!empty($_GET['datepublication'])) ? $_GET['datepublication'] : '';
        $categories = Category::where('is_active','TRUE')->get();

        foreach($categories as $category){
            $category_id = $category['id'];

            if(!empty($datepublication)){
                //$posts = Article::where('rubriqueid',$category_id)->whereRaw('created_at >= curdate()')->where('datepublication',$datepublication)->orderBy('created_at','desc')->get();
                $posts = Article::where('category_id',$category_id)->where('publication_date',$datepublication)->orderBy('created_at','desc')->get();
            }else {
                //$posts = Article::where('is_active','TRUE')->orderBy('created_at','desc')->get();
                $posts = Article::where('category_id',$category_id)->whereRaw('publication_date >= curdate()')->orderBy('created_at','desc')->get();
            }
            
            $category['articles'] = $posts;
        }          

        
        return view('article::index')->with(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $users = (new user)->get_redacteurs();
        $collab = (new user)->get_collaborateurs();
        $category = (new Category)->category_online();
        $chroniques = SubCategory::all()->groupBy('rubrique_id');
        $article = new Article();
        
        $userid = Auth::user()->id;
        
        $user_details = UsersGroups::select('*')
		//->join('users_groups','users_groups.user_id','=','groups.id')
	    ->where('user_id',$userid)
	    ->get();
        $article->datepublication = Carbon::today();
        
        return view('article::create',compact('article', 'category','users','chroniques','collab','user_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $article = $this->updateArticle(new Article(), $req);
    	return redirect("/publications");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $users = (new user)->get_redacteurs();
        $category = (new Category)->category_online();
        $chroniques = Chroniques::all()->groupBy('rubrique_id');
        $collab = (new user)->get_collaborateurs();
        $userid = Auth::user()->id;
        
        $user_details = UsersGroups::select('*')
		//->join('users_groups','users_groups.user_id','=','groups.id')
	    ->where('user_id',$userid)
	    ->get();
	    
        return view('article/new',compact('article', 'category','users','chroniques','collab','user_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article = $this->updateArticle($article, $request);
        return redirect("/publications");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if(!$article){
            return "Invalid Article";
        }

        $article->enligne = "DELETE";
        $article->save();
        return "Article has been deleted!";
    }


    private function updateArticle(Article $article, $data){
        $content = $this->formatArticle($data->post_content);
        $article->surtitle = $data->post_surtitre;
        $article->title = $data->post_titre;
        $article->subtitle = $data->post_soustitre;
        $article->content = $content;
        $article->summary = $data->post_chapeau;
        $article->publication_date = $data->post_date;
        $article->category_id = $data->post_category;
        $article->subcategory_id = $data->post_chronique;
        $article->author_id = $data->post_auteurid;
        $article->author = $data->post_auteur;
        $article->enter_by = $data->post_entrerpar;
        $article->keywords = $data->post_motscles;
        $article->save();
        
        $titre = $data->post_titre;
        $folder = date('Y-m-d');
        $texte = $content;
        
        Storage::put('textesnouvelliste/'.$folder.'/'.$titre.'.txt', $texte);
        
        return $article;
    }

    private function formatArticle($raw){
        $content = "<p>";
        //$content .= str_replace("<br>", "</p><p>", $raw);
        $content .= preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $raw);
        $content .= "</p>";
        //$content .= filter_var($content, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        //$content .= addslashes($content);
        return $content;
    }

    public function addPhoto($id)
    {
        $article = Article::where('id',$id)->first();
        $media_article = MediaArticle::with(['media'])->where('media_article.article_id',$article->id)->get();

        return view('article::add-photo', ['article' => $article, 'media_articles' => $media_article]);
    }

    public function deleteMediaArticle(Request $request)
    {
        $media_article_id = $request->post('media_article_id');
        $article_id = $request->post('article_id');

        if( isset($media_article_id) && !empty($media_article_id) ) {
            MediaArticle::where('id',$media_article_id)->delete();
        }

        return redirect('article/add-photo/'.$article_id);
    }

    public function getMediaPhoto()
    {
        $medias = Media::orderBy('created_at','desc')->get();
       
        return Response::json(\View::make('article::media-gallery', ['media_gallery' => $medias])->render());
    }

    public function addMediaArticle(Request $request)
    {
        $article_id = $request->post('article_id');
        $media_id = $request->post('media_id');

        if(!empty($article_id) && !empty($media_id)) {
            $mediaArticle = new MediaArticle;
            $mediaArticle->article_id = $article_id;
            $mediaArticle->media_id = $media_id;
            $mediaArticle->save();
        }

        return redirect('article/add-photo/'.$article_id);
    }

    public function updateMediaArticlePhoto(Request $request)
    {
        $media_article_id = $request->post('media_article_id');
        $article_id = $request->post('id');

        if( isset($media_article_id) && !empty($media_article_id) ) {
            $media_id = $request->post('media_id');

            $mediaArticle = MediaArticle::find($media_article_id);
            $mediaArticle->media_id = $media_id;
            $mediaArticle->save();
            
        }

        return redirect('article/add-photo/'.$article_id);
    }


    public function addRemoveFeaturedImage(Request $request)
    {
        $media_article_id = $request->post('media_article_id');
        $article_id = $request->post('article_id');

        if(!empty($media_article_id) && !empty($article_id)) {
            $media_article = MediaArticle::where('article_id',$article_id)->where('is_featured','TRUE')->first();
            $add_featured = MediaArticle::find($media_article_id);

            if(!empty($media_article)){
                $remove_featured = MediaArticle::find($media_article->id);
                $remove_featured->is_featured = 'FALSE';
                $remove_featured->save();

                $add_featured->is_featured = 'TRUE';
                $add_featured->save();

                return 'TRUE';
            }else{
                
                $add_featured->is_featured = 'TRUE';
                $add_featured->save();

                return 'TRUE';
            }
        }else{
            return 'FALSE';
        }
    }
}
