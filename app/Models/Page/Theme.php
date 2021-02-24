<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Core\Client;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;

class Theme extends Model
{
    use HasFactory,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'settings',
        'user_id',
        'client_id',
        'agency_id',
        'status',
    ];


    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$user){

    	return $this->where('name','LIKE',"%{$item}%")
                    ->where('client_id',request()->get('client.id'))
                    ->orderBy('created_at','desc')
                    ->paginate($limit);

    }

    /**
     * Get the theme data
     *
     * @var array
     */
    public function getCurrentThemeID(){
       
        $theme =$this->where('slug',request()->get('client.theme.name'))
                    ->first();
        if($theme)
            return $theme->id;

        return null;

    }


    

    /**
     * Refresh the cache data
     *
     */

    public function refreshCache(){

        // get the domain name
        $domain = $this->client->domain;

        // reload the cache
        Cache::forget('theme_'.$domain);
        Cache::forever('theme_'.$domain,$this);


    }

    /**
     * Function to replace the variables
     *
     */

    public function processHtml()
    {
        $content = $this->html;
        $settings = json_decode($this->settings);
        if(preg_match_all('/{+(.*?)}/', $content, $regs))
        {
            foreach ($regs[1] as $reg){
              $variable = $reg;

                $pos_0 = substr($variable,0,1);

                if($pos_0=='$'){
                    $variable_name = str_replace('$', '', $variable);
                    $data = (isset($settings->$variable_name)) ? $settings->$variable_name : '';
                    $content = str_replace('{'.$reg.'}', $data , $content);
                }

                if($pos_0=='@'){
                    $variable_name = str_replace('@', '', $variable);

                    $module = Module::where('client_id',$this->client_id)->where('slug',$variable_name)->first();

                    ($module) ? $data = $module->html_minified : $date = '';
                    $content = str_replace('{'.$reg.'}', $data , $content);
                }
            }
            
        } 

        $content = $this->minifyHtml($content);
        $this->html_minified = $content;
        $this->save();
    }


    /**
     * Function to replace the variables
     *
     */

    public function processSettings()
    {
        $settings = json_decode($this->settings);

        if($settings)
        if(isset($settings->modules))
        foreach($settings->modules as $modulename=>$item){
            
            $module = Module::where('client_id',$this->client_id)->where('slug',$modulename)->first();
            if($module){
                $settings->modules->$modulename = $module;
            }
                
        }

        $this->settings = json_encode($settings);
        $this->save();
    }

    /**
     * Function to minify the html code
     *
     */
    public function minifyHtml($buffer) {

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
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
