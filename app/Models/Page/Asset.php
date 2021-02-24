<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Core\Client;
use App\Models\Page\Module;
use App\Models\Page\Theme;
use App\Models\Page\Page;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'path',
        'type',
        'user_id',
        'client_id',
        'agency_id',
        'theme_id',
        'status',
    ];

       /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$theme_id){
    	return $this->where('name','LIKE',"%{$item}%")
                    ->where('client_id',request()->get('client.id'))
                    ->where('theme_id',$theme_id)
                    ->orderBy('created_at','desc')
                    ->paginate($limit);

    }
    

    /**
     * Refresh the cache data
     *
     */

    public function uploadFile($theme_id,$request){

    	/* If image is given upload and store path */
    	if(isset($request->all()['file'])){
    		$file      = $request->all()['file'];
    		$extension = strtolower($file->getClientOriginalExtension());

    		if(in_array($extension, ['jpg','jpeg','png','gif','svg','webp']))
    			$type = 'images';
    		else if(in_array($extension, ['otf','','ttf','fnt','eot','woff','woff2']))
    			$type = 'images';
    		else
    			$type = $extension;
    			
    		$name_prefix = 'file_'.$theme_id.'_'.$request->get('slug');
    		$filename = $name_prefix.'.'.$extension;

    		$path = Storage::disk('public')->putFileAs('themes/'.$theme_id, $request->file('file'),$filename,'public');

    		$request->merge(['path' => $path]);
    		$request->merge(['type' => $type]);
    	}


    }


    /**
	 * Get the user that owns the page.
	 *
	 */
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	 /**
	 * Get the client that owns the page.
	 *
	 */
	public function client()
	{
	    return $this->belongsTo(Client::class);
	}
}
