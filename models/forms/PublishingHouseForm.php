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
use app\models\PublishingHouse\PublishingPhones;
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
    private $_publishingPhones;
    private $_country;
    private $_region;
    private $_city;

    public function rules()
    {
        return [
            [['PublishingHouse'], 'required'],
            [['PublisherAddresses'], 'required'],
            [['PublishingPhones'], 'required'],
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
        if (!$this->publishingPhones->validate()) {
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

        if (!$this->validate()) {
            return false;
        }
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

            $this->publishingPhones->publisher_id = $this->publishingHouse->id;
            $this->publishingPhones->save();

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
        return $this->_publisherAddresses;
    }

    public function setPublisherAddresses($publisherAddresses)
    {
        if ($publisherAddresses instanceof PublisherAddresses) {
            $this->_publisherAddresses = $publisherAddresses;
        } else if (is_array($publisherAddresses)) {
            $this->_publisherAddresses->setAttributes($publisherAddresses);
        }
    }

    public function getPublishingPhones()
    {
        return $this->_publishingPhones;
    }

    public function setPublishingPhones($publishingPhones)
    {
        if ($publishingPhones instanceof PublishingPhones) {
            $this->_publishingPhones = $publishingPhones;
        } else if (is_array($publishingPhones)) {
            $this->_publishingPhones->setAttributes($publishingPhones);
        }
    }
    public function getCountry()
    {
        return $this->_country;
    }

    public function setCountry($country)
    {
        if ($country instanceof Country) {
            $this->_country = $country;
        } else if (is_array($country)) {
            $this->_country->setAttributes($country);
        }
    }

    public function getRegion()
    {
        return $this->_region;
    }

    public function setRegion($region)
    {
        if ($region instanceof Region) {
            $this->_region = $region;
        } else if (is_array($region)) {
            $this->_region->setAttributes($region);
        }
    }

    public function getCity()
    {
        return $this->_city;
    }

    public function setCity($city)
    {
        if ($city instanceof City) {
            $this->_city = $city;
        } else if (is_array($city)) {
            $this->_city->setAttributes($city);
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
            'PublishingHouse' => $this->publishingHouse,
            'PublisherAddresses' => $this->publisherAddresses,
            'PublishingPhones' => $this->publishingPhones,
            'Country' => $this->country,
            'Region' => $this->region,
            'City' => $this->city,
        ];
    }
}