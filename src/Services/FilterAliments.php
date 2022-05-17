<?php

namespace App\Services;

use App\Entity\Micronutrients;
use App\Repository\AlimentsRepository;
use App\Repository\CategoryAlimentsRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class FilterAliments{

    private $alimentsRepository;
    private $categoryAlimentsRepository;
    public function __construct(AlimentsRepository $alimentsRepository, CategoryAlimentsRepository $categoryAlimentsRepository)
    {
        $this->alimentsRepository = $alimentsRepository;
        $this->categoryAlimentsRepository = $categoryAlimentsRepository;
    }

    /**
     * Get an array of aliments from the query on the request
     * 
     * @param Request $request the actual request
     * @return Aliments[] 
     * @throw Exception error 
     */
    public function getAlimentsFilterFromRequest(Request $request){
        // dd($form, $form->getData());
        // dd($request, $request->query->all(), array_key_exists('filter_aliments', $request->query->all()));
        if(array_key_exists('filter_aliments', $request->query->all())){
            
            $filterAliments = $request->query->all()['filter_aliments'];
            $criteria = [];

            if($filterAliments['type'] != ''){

                $cateAliment = $this->categoryAlimentsRepository->findOneBy(['id'=>$filterAliments['type']]);
                if(!$cateAliment) throw new Exception("cateAliment is null, expected CategoryAliment", 1);
                $criteria['categoryAliments'] = $cateAliment;
            }

            if($filterAliments['season'] != ''){
                $seasons = [
                    'Printemps',
                    'Été',
                    'Automne',
                    'Hiver'
                ];

                if(!in_array($filterAliments['season'],$seasons))throw new Exception(sprintf("not expected season, given %s", $filterAliments['season']), 1);
                    
                $criteria['seasonsToConsume'] = $filterAliments['season'];
            }

            if(empty($criteria))return $this->getAlimentsDefault();

            // dd($filterAliments);
            // dd($criteria);
            $aliments = $this->alimentsRepository->findByFilter($criteria);
            if(array_key_exists('seasonsToConsume', $criteria)){
            $alimentsSeason = [];
            foreach ($aliments as $key => $aliment) {
                if(in_array($criteria['seasonsToConsume'], $aliment->getSeasonsToConsume())){
                    $alimentsSeason[] = $aliment;
                }
            }
            $aliments = $alimentsSeason;
        }

        return $aliments;

        }else{
            throw new Exception("filter_aliments is not in the query", 1);
            
        }

        
    }

    /**
     * Get an default array of aliments 
     * 
     * @return Aliments[] 
     */
    public function getAlimentsDefault(){
        return $this->alimentsRepository->findBy([], ['id'=>'ASC']);
    }

    /**
     * Return an array of micronutrients from an array of aliments
     * 
     * @param Aliments[] $aliments 
     * @return [] 
     */
    public function createAndOrderMicronutrimentsArray($aliments):array
    {
        $micros = [];
        
        foreach ($aliments as $key => $aliment) {
            
            $micronutriment = $aliment->getMicronutrients()->getValues();
            $micros[$key] = $this->getMicronutrientsAsArray($micronutriment);
            
            
        }
        return $micros;
    }

    /**
     * Return an array with all micronutrients filtered and sorted
     * 
     * @param Micronutients[] $micronutriment an array of micronutrient
     * @return [] 
     */
    public function getMicronutrientsAsArray(array $micronutriment):array
    {

        $array = [];
        
        foreach ($micronutriment as $key2 => $value) {
            if(!$value instanceof Micronutrients) continue;
            
            if(array_key_exists($value->getCategory()->__toString(), $array)){
                $array[$value->getCategory()->__toString()][] = $value;
            }
            else{
                $array[$value->getCategory()->__toString()] = [$value];
            }

            if($key2 === array_key_last($micronutriment)) {

             usort($array[$value->getCategory()->__toString()], 
                function ($a, $b) {
                return strcmp($a->getName(), $b->getName());
                });

             }
            
         }

         return $array;
    }


}