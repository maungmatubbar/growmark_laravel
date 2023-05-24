<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderCollection;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function sliderList()
    {
        try
        {
            $sliders = Slider::get();
            $collection = new SliderCollection($sliders);
            return $this->successResponse($collection,'');
        }
        catch (\Exception $exception)
        {
            $errors['message'] = $exception->getMessage();
            return $this->errorResponse($errors,'Exception Error');
        }
    }
}
