<?php

namespace App\Controllers;

use App\CentimeterConverter;
use App\FeetConverter;
use App\InchesConverter;
use App\Interfaces\Measurement;
use App\MetresConverter;
use App\Models\Garden;
use App\YardConverter;
use Core\Request;

class GardenCalculator
{
    public Garden $garden;

    public function __construct()
    {
        $this->garden = new Garden();
    }

    public function loadView()
    {
        require 'views/home.php';
    }

    public function gardens()
    {
        header('Content-Type:application/json');

        echo json_encode(['gardens' => $this->garden->fetchAll()]);
    }

    public function setMeasurementUnit($unit)
    {
        $this->garden->setMeasurementUnit($unit);
    }

    public function setDepthMeasurementUnit($unit)
    {
        $this->garden->setDepthUnit($unit);
    }

    public function setDimensions($width, $length, $depth)
    {
        $this->garden->setLength($length);

        $this->garden->setDepth($depth);

        $this->garden->setWidth($width);
    }

    public function calculateNumberOfBags(Measurement $measurement)
    {
        $lengthInMetres = $measurement->measurementUnit(
            $this->garden->getLength()
        );

        $widthInMetres = $measurement->measurementUnit(
            $this->garden->getWidth()
        );

        $area = $lengthInMetres * $widthInMetres;

        $numberOfBags = round(($area * 0.025) * 1.4);

        $costOfBags = $numberOfBags * 72;

        $this->garden->setNumberOfBags($numberOfBags);

        $this->garden->setCost($costOfBags);
    }

    public function measurementStrategy($unit): Measurement
    {
        switch ($unit) {
            case 'Centimetres':
                return new CentimeterConverter();
            case 'Inches':
                return new InchesConverter();
            case 'Yards':
                return new YardConverter();
            case 'Feet':
                return new FeetConverter();
            default:
                return new MetresConverter();
        }
    }

    public function calculateOrAddToBasket()
    {
        try {
            $inputs = Request::input();

            $this->setMeasurementUnit($inputs['unitForDimensions']);

            $this->setDepthMeasurementUnit($inputs['unitForDepth']);

            $this->setDimensions(
                $inputs['width'],
                $inputs['length'],
                $inputs['depth']
            );

            $measurement = $this->measurementStrategy(
                $inputs['unitForDimensions']
            );

            $this->calculateNumberOfBags($measurement);

            if ($inputs['addToBasket'] === 'true') {
                $garden = $this->save();
            } else {
                $garden = [
                    'number_of_bags' => $this->garden->getNumberOfBags(),
                    'cost' => $this->garden->getCost()
                ];
            }

            header('Content-Type:application/json');

            echo json_encode([
                'message' => 'success',
                'garden' => $garden
            ]);
        } catch (\Exception $e) {
            header('Content-Type:application/json');

            echo json_encode([
                'message' => 'error',
                'error' => 'Something went wrong'
            ]);
        }
    }

    public function save(): array
    {
        return $this->garden->save();
    }
}
