<?php
/**
 * Created by PhpStorm.
 * User: MVYaroslavcev
 * Date: 26/02/19
 * Time: 11:42
 */

namespace frontend\models;

use common\models\Application;
use Yii;
use yii\base\Model;

class ApplicationForm extends Model
{
    public $fullName;
    public $text;
    public $city;
    public $address;

    public function rules()
    {
        return [
            ['fullName', 'required'],
            ['fullName', 'string', 'min' => 3, 'max' => 255],

            ['text', 'required'],
            ['text', 'string', 'max' => 200],

            ['city', 'required'],
            ['city', 'string'],

            ['address', 'required'],
            ['address', 'string'],
        ];
    }

    public function application()
    {
        if (!$this->validate()) {
            return null;
        }

        $coords = $this->getCoordinates($this->city, $this->address);
        if (!$coords)
        {
            return null;
        }
        $application = new Application();
        $application->full_name = $this->fullName;
        $application->text = $this->text;
        $application->city = $this->city;
        $application->address = $this->address;
        $application->lat = $coords['lat'];
        $application->lon = $coords['lon'];

        return $application->save() ? $application : null;
    }
    private function getCoordinates($city, $address)
    {
        $result = false;
        $fullAddress = $city.', '.$address;

        $xml = simplexml_load_file('http://geocode-maps.yandex.ru/1.x/?geocode='.urlencode($fullAddress).'&key='.urlencode('e261095e-d891-449b-a85a-762c97e1c9e1').'&results=1');

        $found = $xml->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found;

        if ($found > 0)
        {
            $coords = str_replace(' ', ',', $xml->GeoObjectCollection->featureMember->GeoObject->Point->pos);
            $coords  = explode(',', $coords);

            $result = ['lon'=>$coords[0], 'lat'=>$coords[1]];
        }
        return $result;
    }

    public function convertForJson()
    {
        $result = false;
        $query = Application::find();

        $applicationList = $query->all();

        $applicationArray = [];

        foreach ($applicationList as $application)
        {
            $applicationArray[] = [
                'name'=>$application->full_name,
                'description'=>$application->text,
                'lattitude'=>$application->lat,
                'longitude'=>$application->lon
                ];
        }

        $json = json_encode($applicationArray, JSON_UNESCAPED_UNICODE);
        if ($json)
        {
            $realPath=$_SERVER['DOCUMENT_ROOT'];
            if (!file_exists($realPath.'/data'))
            {
                mkdir($realPath.'/data');
            }
            file_put_contents($realPath.'/data/application.json', $json);

            $fesult = true;

        }

        return $result;
    }

}