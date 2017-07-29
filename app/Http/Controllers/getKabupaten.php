<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getKabupaten extends Controller
{
    public function getKabupatenAll(){
      	//Get Data Kabupaten
        $curl = curl_init();	
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 0e859f70f2a6a110e4a2a60a57b35b3e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        return json_decode($response, true);
        curl_close($curl);
    }

    public function getDataProvinsi(){
        //Get Data Provinsi
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 0e859f70f2a6a110e4a2a60a57b35b3e"
        ),
        ));

        $responseProvinsi = curl_exec($curl);
        $err = curl_error($curl);

        return json_decode($responseProvinsi, true);
    }

    public function getKabupaten($id){
        $provinsi_id = $id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 0e859f70f2a6a110e4a2a60a57b35b3e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        //echo $response;
        }

        $data = json_decode($response, true);
        return $data;
        // for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
        //     echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
//}
    }

    public function cekOngkir(Request $request){
        $asal = $_POST['asal'];
        $id_kabupaten = $_POST['kab_id'];
        $kurir = $_POST['kurir'];
        $berat = $_POST['berat'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 0e859f70f2a6a110e4a2a60a57b35b3e"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);


        curl_close($curl);

        if ($err) {
        return "cURL Error #:" . $err;
        } else {
        return json_decode($response, true);
        }
    }
}
