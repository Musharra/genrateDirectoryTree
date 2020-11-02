<?php
namespace App\Http\Controllers\directory_files;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectoryController extends Controller
{
	private $files;
	private $folder;
	// protected $modelObj;
	
		  
  function __construct( ) {
		  
		//print_r($this->files);die;
	}
		
		// $this->RegisterModel   =  new RegisterModel();
		// $this->modelObj        =  new CommonModel();
		 
	  
  public function DirectoryList(){ 
  
          $files = array();	
		
		/*if( file_exists($request=>path)) {
			if( $request=>path[ strlen($request=>path ) - 1 ] ==  '/' )
				$this->folder = $request=>path;
			else
				$this->folder = $request=>path . '/';
			
			$this->dir = opendir( $request=>path );
			while(( $file = readdir( $this->dir ) ) != false )
				$this->files[] = $file;
			closedir( $this->dir );
		} */
	 
      	  return view('welcome');
	     }
  
function create_tree(request $req ) {
	
	      $path=$req->dir;
		  $files = array();	
		
		if( file_exists( $path)) {
			if( $path[ strlen( $path ) - 1 ] ==  '/' )
				$this->folder = $path;
			else
				$this->folder = $path . '/';
			
			$this->dir = opendir( $path );
			while(( $file = readdir( $this->dir ) ) != false )
				$this->files[] = $file;
			closedir( $this->dir );
		}
			
		if( count( $this->files ) > 2 ) { 
		
		   /* First 2 entries are . and ..  -skip them */
			natcasesort( $this->files );
			$list = '<ul class="filetree" id="" style="display: none;">';
			// Group folders first
			foreach( $this->files as $file ) {
				if( file_exists( $this->folder . $file ) && $file != '.' && $file != '..' && is_dir( $this->folder . $file )) {
					$list .= '<li class="folder collapsed"><a  rel="' . htmlentities( $this->folder . $file ) . '/">' . htmlentities( $file ) . '</a></li>';
				}
			}
			// Group all files
			foreach( $this->files as $file ) {
				if( file_exists( $this->folder . $file ) && $file != '.' && $file != '..' && !is_dir( $this->folder . $file )) {
					$ext = preg_replace('/^.*\./', '', $file);
					$list .= '<li class="file ext_' . $ext . '"><a href="#" rel="' . htmlentities( $this->folder . $file ) . '">' . htmlentities( $file ) . '</a></li>';
				}
			}
			$list .= '</ul>';	
			return $list;
		}
	}
	   

}
