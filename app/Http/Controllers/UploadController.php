<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PdfModel;
use Illuminate\Filesystem\Filesystem;
// use Validator;
use DB;
use Pacuna\Schemas\Facades\PGSchema;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;


class UploadController extends Controller
{
	public function upload(){		
		 $schemas = DB::select("SELECT schema_name FROM information_schema.schemata where schema_name not like 'information_schema' and schema_name not like 'pg_%' and schema_name not like 'public'");

		return view('upload', ['schemas' => $schemas]);
	}

	 // public function schem()
  //   {
  //   	$selectSchem = DB::table('ni_Tahun_2011')->select('*')->get();
  //   	return $selectSchem;
  //   }

	public function proses_upload(Request $request){
		// menyimpan data file yang diupload ke variabel $file
		// $this->validate($request, [
		//    'file' => 'required',
		//    'zip' => 'required',
  //       ]);
        $pdf = $request->file('pdf');
		$file = $request->file('zip');
		// return $pdf;
		if($pdf != null){
			$userId = $request->session()->get('activeUser')->kode_wil;
	        $path = $pdf->move('uploaded-File/'.$userId.'/'.'Pdf/',$pdf->getClientOriginalName());
	        $datapdf = new PdfModel();
	        $datapdf->file_pdf=$path;
	        $datapdf->kode_wil=$userId;
	        $datapdf->id_pdf=strtotime(date("Y-m-d H:i:s"));
	        $datapdf->save();

		}
		if($file != null){
	        $filename = substr($file->getClientOriginalName(),0,-4);
	        $fileExtension = $file->getClientOriginalExtension();
	        $fileNameWithExtension = $filename.'.'.$fileExtension;
	        // $filePath = $file->getRealPath();
	        // $fileSize = $file->getSize();
	        // $fileType = $file->getMimeType();
	    	
	        $userId = $request->session()->get('activeUser')->kode_wil;
	        $uploadFolder = 'uploaded-File';

	        // code buat rename file double
	        $zipFolder = 'uploaded-File/'.$userId.'/'.'Zip/';
	        $i = 1;
	        while (file_exists($zipFolder.$fileNameWithExtension)) {
	            $new_fname = $filename.'-'.$i;
	            $fileNameWithExtension = $new_fname.'.'.$fileExtension;
	            $i++;
	        }

	        $newName = substr($filename,9);
	        $file->move($zipFolder,$fileNameWithExtension);

	        // Hapus directory temp dulu sbl ekstrak
	        $deleteDir = new Filesystem;
	        $deleteDir->cleanDirectory('uploaded-File/'.$userId.'/'.'Temp/');

	        // Ekstraksi file
	        $Path = public_path('uploaded-File/'.$userId.'/'.'Zip/'.$fileNameWithExtension);
	        \Zipper::make($Path)->extractTo('uploaded-File/'.$userId.'/'.'Temp/');
 
	        // Renaming File
	        $length = strlen($filename);
	        $renamePath = 'uploaded-File/'.$userId.'/'.'Temp/';
	        $filesInFolder = \File::files($renamePath);
	        foreach($filesInFolder as $path) { 
	              $file = pathinfo($path);
	              $name = $file['basename'];
	              $fullExtension = substr($name,$length);
	              rename($renamePath.$name,$renamePath.$newName.$fullExtension);
	        }

	          $pathTemp = public_path('uploaded-File/'.$userId.'/'.'Temp');
	        //dd(glob($filenameZip . "/*.prj"));
	        // return glob($pathTemp . "/*.prj");
	        foreach (glob($pathTemp . "/*.prj") as $filename) {
	            $file_prj = str_replace("/", "\\", $filename);
	        }
	        // return $file_prj;
	        $epsg = (int) shell_exec("python C:\Users\ASUS\Documents\Python\getEPSG.py ".$file_prj);

	        // globe-> mengambil isi dari folder yang dipilih
	        foreach (glob($pathTemp . "/*.shp") as $filename) {
	            $filename_new = str_replace("/", "\\", $filename);
	            $table_name = basename($filename_new, ".shp");
	            $table_name_new = str_replace(" ", "_", $table_name);
	        }


	        //return ('"C:\Program Files\PostgreSQL\11\bin\shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $userId . '.' . $table_name_new . ' | "C:\Program Files\PostgreSQL\11\bin\psql" -U postgres -P farah -d sitrg');
	        
			// // here 4326 is spatial reference system or coordinate system of the shape file.

			// $command = escapeshellcmd('"C:\Program Files\PostgreSQL\11\bin\shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $userId . '.' . $table_name_new . ' | "C:\Program Files\PostgreSQL\11\bin\psql" -U postgres -d sitrg');
			// $output = shell_exec($command);
			// echo $output;

	         $test = shell_exec('"C:\Program Files\PostgreSQL\11\bin\shp2pgsql" -I -s '. $epsg .' '. $filename_new . ' ' . $userId . '.' . $table_name_new . ' | "C:\Program Files\PostgreSQL\11\bin\psql" -U postgres -d sitrg');
	         
	         $this->request_workspace($userId);
        	 $this->post_store($userId);

        	 // $public = "public";
        	 
        	 shell_exec("python C:\Users\ASUS\Documents\Python\publishLayer.py ". $userId .' '. $table_name .' '. $epsg); 

		}

		return redirect('/upload')->with('sukses','Data berhasil diinput');
		echo "success";
	}
	 public function post_workspace(String $name)
    {
        $client = new Client();
        $res = $client->request('POST', 'http://localhost:2012/geoserver/rest/workspaces', [
            'auth' => ['admin', 'geoserver'],
            'json' => [
                'workspace' => [
                    'name' => $name
                ]
            ]
        ]);
    }

    public function request_workspace(String $name)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://localhost:2012/geoserver/rest/workspaces/', [
            'auth' => ['admin', 'geoserver']
        ]);
//      menampilkan json
//      dd((string) $res->getBody());
        $responsArray = json_decode($res->getBody());
        foreach ($responsArray->workspaces as $num => $item) {
            foreach ($item as $no => $piece) {
                echo "workspace:";
                 $resultname = $piece->name;
                echo $resultname."<br>";
                echo "input:". $name."<br>";
                if ($name == $resultname){
                    $result=1;
                    break;
                    }
                else{
                    $result=0;
                }
            }
            if ($result==0) {
                $this->post_workspace($name);
            }
//            else
//                $this->put_workspace($name);
            $workspacename=$name;
        }
    }

    public function post_store(String $name)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:2012/geoserver/rest/workspaces/". $name ."/datastores");
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array("Content-type: application/xml", 'Authorization: Basic YWRtaW46Z2Vvc2VydmVy'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, "<dataStore>
                                                            <name>".$name."</name>
                                                            <connectionParameters>
                                                            <SPI>org.geotools.data.postgis.PostgisNGDataStoreFactory</SPI>
                                                            <host>localhost</host>
                                                            <port>5432</port>
                                                            <database>sitrg</database>
                                                            <schema>".$name."</schema>
                                                            <user>postgres</user>
                                                            <passwd></passwd>
                                                            <bbox>true</bbox>
                                                            <extends>false</extends>
                                                            <connections>true</connections>
                                                            <timeout>300</timeout>
                                                            <preparedStatements>true</preparedStatements>
                                                            <dbtype>postgis</dbtype>
                                                            </connectionParameters></dataStore>");
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $str = curl_exec($ch);
        curl_close($ch);
    }



}