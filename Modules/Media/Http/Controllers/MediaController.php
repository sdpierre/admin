<?php

namespace Modules\Media\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Routing\Controller;
use App\Media;
use App\Article;
use App\MediaArticle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\MediaKeywords;
use DB;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {	
        $keyword = (!empty($_GET['keyword'])) ? explode(',', $_GET['keyword']) : '';
        $title = (!empty($_GET['title'])) ? $_GET['title'] : '';
        $folder = (!empty($_GET['folder'])) ? $_GET['folder'] : '';

        $title = preg_replace('/[^A-Za-z0-9\-+]/', '', $title);
        $keyword = preg_replace('/[^A-Za-z0-9\-+]/', '', $keyword);

        $count = 0;
        $allMediaFiles = Media::with(['keyword']);
        if(!empty($keyword)){
             $allMediaFiles->whereHas('keyword', function($q) use($keyword){
                $q->whereIn('keyword',$keyword);
            });
        }
        if(!empty($title)){
            $allMediaFiles->where(function($q) use ($title) { 
                $q->where('title', 'LIKE', '%' . $title . '%')
                ->orWhere('photographer', 'LIKE', '%' . $title . '%');
             });
        }
        if(!empty($folder)){
            $allMediaFiles->where('folder_date', 'LIKE', "%{$folder}%");
        }else {
             $current_date = date('Y-m');
    		 $allMediaFiles->Where('folder_date', 'LIKE', "%{$current_date}%");
        }
        $count = $allMediaFiles->count();
        $allMediaFiles = $allMediaFiles->orderBy('created_at','desc')->paginate(5);
      

        $all = [];
        for($i=1;$i<=12;$i++){
            $row = [];
            $from_date = date('Y-'.$i.'-01');
            $to_date = date('Y-'.$i.'-t');
            $media = Media::whereBetween(DB::raw('DATE(created_at)'), array($from_date, $to_date))->get();
            if(count($media)>0){
                $row['date']  = date('Y-m',strtotime($from_date));
                $row['month_name']  = date("F Y",strtotime($from_date));
                $all[] = $row;
            }
        }
        return view('media::index')->with(['allMediaFiles' => $allMediaFiles , 'existingMonths' => $all , 'count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('media::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $user = auth()->user();

        $file = $request->file('file');

        //Display File Name
        $random = rand(0,10000);
        $getClientOriginalName = $file->getClientOriginalName();
        $explFileName = explode('.', $getClientOriginalName);
        $randomFileName = $explFileName[0]."_".$random;
        $createNewFileName = $randomFileName.".".$explFileName[1];
       
        $getClientOriginalExtension = $file->getClientOriginalExtension();
        $getRealPath = $file->getRealPath();
        $getSize = $file->getSize();
        $getMimeType = $file->getMimeType();

        list($width, $height) = getimagesize($getRealPath);

        if ($width > 400 || $height > 600) {
            $dir = public_path('images_lenouvelliste/articles/').date('Y-m-d')."/";

            if(!is_dir($dir)){
              mkdir($dir, 0777, true);
            }

            // Move upload file
            $file->move($dir,$createNewFileName);

            $media = new Media;
            $media->filetype = $getMimeType;
            $media->filename = $createNewFileName;
            $media->folder_date = date('Y-m-d');
            $media->uploaded_by = $user->id;
            $media->created_at = date('Y-m-d H:i:s');
            $media->updated_at = date('Y-m-d H:i:s');
            $media->save();
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('media::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
       
        $id = $request->post('image_id');
        $keywords = $request->post('keywords');

        //print_r($keywords);die;

    	if( isset($id) && !empty($id) ) {

        	$media = Media::find($id);

        	$filename = $media->filename;
        	$folder_date = $media->folder_date;

	        // Remote image URL
			$crop_img_url = $request->post('crop_img_url');

			if(isset($crop_img_url) && !empty($crop_img_url)){
				// Image path
				$dir = public_path('images_lenouvelliste/articles/').$folder_date."/".$filename;

				// Save image 
				file_put_contents($dir, file_get_contents($crop_img_url));
				$thumb_dir = public_path('images_lenouvelliste/articles/').$folder_date."/thumb/";
		        if(!is_dir($thumb_dir)){
		          mkdir($thumb_dir, 0777, true);
		        }

                $random = rand(0,10000);
                $explFileName = explode('.', $filename);
                $randomFileName = $explFileName[0]."_thumb";
                $createNewThumbnailName = $randomFileName.".".$explFileName[1];
	        	
	        	$this->create_thumb($dir, $thumb_dir.'/'.$createNewThumbnailName, 200, 200);

                $media->thumb = $createNewThumbnailName;
			}

	        $media->title = $request->post('title');
            $media->description = $request->post('description');
            $media->photographer = $request->post('photographer');
	        $media->save();

            if(!empty($keywords)){

                DB::table('media_keywords')->where('media_id','=',$id)->delete();

                $keyword_array = explode(',', $keywords);

                foreach ($keyword_array as $value) {
                    $media_keyword = new MediaKeywords;
                    $media_keyword->media_id = $id;
                    $media_keyword->keyword = $value;
                    $media_keyword->save();
                }
            }
        }

        return redirect('media');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->post('del_image_id');

    	if( isset($id) && !empty($id) ) {
    		$res=Media::where('id',$id)->delete();
            MediaKeywords::where('media_id',$id)->delete();
            MediaArticle::where('media_id',$id)->delete();
    	}

    	return redirect('media');
    }

    public function bulkDelete(Request $request)
    {
    	$media_id_array = $request->post('media_id');

    	if( (!empty($media_id_array)) && (count($media_id_array) > 1 ) ) {
    		foreach ($media_id_array as $key => $media) {
    			$res=Media::where('id',$media)->delete();
                MediaKeywords::where('media_id',$media)->delete();
                MediaArticle::where('media_id',$media)->delete();
    		}
    	}else{
    		$res=Media::where('id',$media_id_array[0])->delete();
            MediaKeywords::where('media_id',$media_id_array[0])->delete();
            MediaArticle::where('media_id',$media_id_array[0])->delete();
    	}

    	return redirect('media');
    }

    public function cropimage()
    {
    	$img_r = imagecreatefromjpeg($_GET['img']);
		$dst_r = ImageCreateTrueColor( $_GET['w'], $_GET['h'] );
		 
		imagecopyresampled($dst_r, $img_r, 0, 0, $_GET['x'], $_GET['y'], $_GET['w'], $_GET['h'], $_GET['w'],$_GET['h']);
		  
		header('Content-type: image/jpeg');
		imagejpeg($dst_r);
    }

    public function create_thumb($src, $dest, $desired_width, $desired_height)
    {
		/* read the original image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
		$virtual_image = ImageCreateTrueColor($desired_width, $desired_height);
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0,
		$desired_width, $desired_height, $width, $height);
		header('Content-Type: image/jpeg');
		imagejpeg($virtual_image, $dest);
	}

    public function getAllArticles()
    {
        $title = (isset($_GET['title']) && !empty($_GET['title'])) ? $_GET['title'] : '';

        if(!empty($title)) {
            $articles = Article::select('id_article' ,'titre', 'created_at', 'ispublished')->where('titre', 'like', '%'.$title.'%')->orderBy('created_at', 'desc')->paginate(15);
        }else{
            $articles = Article::select('id_article' ,'titre', 'created_at', 'ispublished')->orderBy('created_at', 'desc')->paginate(15);
        }

        return Response::json(\View::make('media::articles', ['articles' => $articles])->render());
    }

    public function addFeaturedImage(Request $request)
    {
        $media_id = $request->post('media_id');
        $article_id = $request->post('article_id');

        $article = new MediaArticle;
        $article->media_id = $media_id;
        $article->article_id = $article_id;
        $article->save();

        $media = Media::find($media_id);
        $media->is_featured = 'TRUE';
        $media->updated_at = date('Y-m-d H:i:s');
        $media->save();

        return redirect('media');
    }

    public function detach(Request $request)
    {
        $media_id = $request->segment('3');

        if( isset($media_id) && !empty($media_id) ) {
            $media = Media::find($media_id);
            $media->is_featured = 'FALSE';
            $media->updated_at = date('Y-m-d H:i:s');
            $media->save();

            $res = MediaArticle::where('media_id',$media_id)->delete();
        }

        return redirect('media');
    }
}
