<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Http\JsonResponse;

class ApexController extends Controller
{   
    public function getProfile(Request $request) {
        // ↓をURLにいれる
        $platform = $request->platform;
        $userName = $request->name;
        $response = [];
        //アクセストークンはAPIキーだけだといらない
        $baseUrl = "https://public-api.tracker.gg/v2/apex/standard/profile/";
        $path = $platform."/".$userName;
        $url = $baseUrl.$path;
        $headers = [
            "Content-Type: application/json",
            "TRN-Api-Key: ceedbeab-cfe3-4599-bc5d-bb63ecc77ba5",
            "Accept: application/json"
        ];

        $result = self::request($url,"GET",null,$headers);//request()は下に記述
        
        //sample
        // if ($result["status_code"] !== 200) {
        //     $response["message"] = "通信エラー";
        //     return new JsonResponse($response, 500);
        // }
        // $response["body"] = $result["body"];
        // $response["message"] = "success";

        //↓インスタンスで返してる。何が問題なんやろ
        // return new JsonResponse($response);
        //↓jsonで返す、記事によるとこれもインスタンスと言ってる奴がある？
        // return response()->json($result);
        //そのまま返せばよくね？
        return $result;
    }
    public function getSessions(Request $request) {
        // ↓をURLにいれる
        $platform = $request->platform;
        $userName = $request->name;
        $baseUrl = "https://public-api.tracker.gg/v2/apex/standard/profile/";
        $path = $platform."/".$userName.'/sessions';
        $url = $baseUrl.$path;
        $headers = [
            "Content-Type: application/json",
            "TRN-Api-Key: ceedbeab-cfe3-4599-bc5d-bb63ecc77ba5",
            "Accept: application/json"
        ];

        $result = self::request($url,"GET",null,$headers);//request()は下に記述
        
        //sample
        // if ($result["status_code"] !== 200) {
        //     $response["message"] = "通信エラー";
        //     return new JsonResponse($response, 500);
        // }
        // $response["body"] = $result["body"];
        // $response["message"] = "success";

        //↓インスタンスで返してる。何が問題なんやろ
        // return new JsonResponse($response);
        //↓jsonで返す、記事によるとこれもインスタンスと言ってる奴がある？
        // return response()->json($result);
        //そのまま返せばよくね？
        return $result;
    }
    
    public function getUser(Request $request) {
        $platform = $request->platform;
        $userName = $request->name;
        $response = [];
        //アクセストークンはAPIキーだけだといらない
        $baseUrl = "https://public-api.tracker.gg/v2/apex/standard/search?";
        // $queryParams = "?platform=origin&query=pygmalion8787";
        $queryParams = "platform=".$platform."&"."query=".$userName;
        
        $url = $baseUrl.$queryParams;
        $headers = [
            "Content-Type: application/json",
            "TRN-Api-Key: ceedbeab-cfe3-4599-bc5d-bb63ecc77ba5",
            "Accept: application/json"
        ];

        $result = self::request($url,"GET",null,$headers);//request()は下に記述
        
        if ($result["status_code"] !== 200) {
            $response["message"] = "通信エラー";
            return new JsonResponse($response, 500);
        }
        $response["body"] = $result["body"];
        $response["message"] = "success";

        //↓インスタンスで返してる。何が問題なんやろ
        // return new JsonResponse($response);
        //↓jsonで返す、記事によるとこれもインスタンスと言ってる奴がある？
        return response()->json($response);
    }
    
    private static function request($url, $method, $body, $headers) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//error対策
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        
        //sample
        //postする時用？
        // if (!empty($body)) {
        //     curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        // }
     
        $responseJsonText = curl_exec($curl);
        $body = json_decode($responseJsonText , true);
     
        $httpCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl); // curlの処理終わり
        
        //sample
        // $result = [];
        // $result['status_code'] = $httpCode;
        // $result['body'] = $body;

        //自分で作った統一規格で返したい時
        // return $result;
        //そのまま返す
        return $body;
        
        
     }
}
