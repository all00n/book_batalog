<?php
/**
 * Created by PhpStorm.
 * User: r8
 * Date: 03.03.19
 * Time: 14:22
 */

namespace app\models\forms;

use app\models\PublishingHouse\PublishingHouse;
use app\models\PublishingHouse\PublisherAddresses;
use app\models\PublishingHouse\Country;
use app\models\PublishingHouse\Region;
use app\models\PublishingHouse\City;

use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class PublishingHouseForm extends Model
{
    private $_publishingHouse;
    private $_publisherAddresses;
    private $_country;
    private $_region;
    private $_city;

    public function rules()
    {
        return [
            [['PublishingHouse'], 'required'],
            [['PublisherAddresses'], 'required'],
            [['Country'], 'required'],
            [['Region'], 'required'],
            [['City'], 'required'],
        ];
    }

    public function afterValidate()
    {
        $error = false;
        if (!$this->publishingHouse->validate()) {
            $error = true;
        }
        if (!$this->publisherAddresses->validate()) {
            $error = true;
        }
        if (!$this->country->validate()) {
            $error = true;
        }
        if (!$this->region->validate()) {
            $error = true;
        }
        if (!$this->city->validate()) {
            $error = true;
        }
        if ($error) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {

//        if (!$this->validate()) {
//            return false;
//        }

        $transaction = Yii::$app->db->beginTransaction();

        try{

            $this->country->save();
            $this->region->save();
            $this->city->save();

            $this->publisherAddresses->country_id = $this->country->id;
            $this->publisherAddresses->region_id = $this->region->id;
            $this->publisherAddresses->city_id = $this->city->id;
            $this->publisherAddresses->save(false);

            $this->publishingHouse->address_id = $this->publisherAddresses->id;
            $this->publishingHouse->save(false);

            $transaction->commit();
            return true;
        }catch (\Exception $err) {
            $transaction->rollBack();
            return false;
        }
    }

    public function getPublishingHouse()
    {
        return $this->_publishingHouse;
    }

    public function setPublishingHouse($publishingHouse)
    {
        if ($publishingHouse instanceof PublishingHouse) {
            $this->_publishingHouse = $publishingHouse;
        } else if (is_array($publishingHouse)) {
            $this->_publishingHouse->setAttributes($publishingHouse);
        }
    }

    public function getPublisherAddresses()
    {
        if ($this->_publisherAddresses === null) {
            if ($this->publishingHouse->isNewRecord) {
                $this->_publisherAddresses = new PublisherAddresses();
                $this->_publisherAddresses->loadDefaultValues();
            } else {
                $this->_publisherAddresses = $this->publishingHouse->publisherAddresses;
            }
        }
        return $this->_publisherAddresses;
    }

    public function setPublisherAddresses($publisherAddresses)
    {
        if (is_array($publisherAddresses)) {
            $this->publisherAddresses->setAttributes($publisherAddresses);
        } elseif ($publisherAddresses instanceof PublisherAddresses) {
            $this->_publisherAddresses = $publisherAddresses;
        }
    }

    public function getCountry()
    {
        if ($this->_country === null) {
            if ($this->publishingHouse->isNewRecord) {
                $this->_country = new Country();
                $this->_country->loadDefaultValues();
            } else {
                $this->_country = $this->publisherAddresses->country;
            }
        }
        return $this->_country;
    }

    public function setCountry($country)
    {
        if (is_array($country)) {
            $this->country->setAttributes($country);
        } elseif ($country instanceof Country) {
            $this->_country = $country;
        }
    }

    public function getRegion()
    {
        if ($this->_region === null) {
            if ($this->publishingHouse->isNewRecord) {
                $this->_region = new Region();
                $this->_region->loadDefaultValues();
            } else {
                $this->_region = $this->publisherAddresses->region;
            }
        }
        return $this->_region;
    }

    public function setRegion($region)
    {
        if (is_array($region)) {
            $this->region->setAttributes($region);
        } elseif ($region instanceof Region) {
            $this->_region = $region;
        }
    }

    public function getCity()
    {
        if ($this->_city === null) {
            if ($this->publishingHouse->isNewRecord) {
                $this->_city = new City();
                $this->_city->loadDefaultValues();
            } else {
                $this->_city = $this->publisherAddresses->city;
            }
        }
        return $this->_city;
    }

    public function setCity($city)
    {
        if (is_array($city)) {
            $this->city->setAttributes($city);
        } elseif ($city instanceof City) {
            $this->_city = $city;
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
                'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        return [
            'PublishingHouse'       => $this->publishingHouse,
            'PublisherAddresses'    => $this->publisherAddresses,
            'Country'               => $this->country,
            'Region'                => $this->region,
            'City'                  => $this->city,
        ];
    }
}