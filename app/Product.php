<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $dataPath = 'app/data/products.json';

    public function saveDataToJson($inputData)
    {
        $col = Collection::make($inputData);

        try{
            if (file_exists(storage_path($this->dataPath)))
                $data = json_decode(Storage::get($this->dataPath),true);

            if(!isset($data))
                $data = array();

            array_push($data,$inputData);

            $col = collect($data);
            $col->sortByDesc("date")->toArray();
            if(Storage::put($this->dataPath,json_encode($data)));
            return $inputData;


        }catch (\Exception $e){
            Log::error($e->getMessage());
            return array();
        }

    }

    public function getDataFromJson(){

        if(file_exists(storage_path($this->dataPath)))
            return json_decode(file_get_contents(storage_path($this->dataPath)));
        else
            return array();
    }
}
