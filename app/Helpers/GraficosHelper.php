<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 25/2/2019
 * Time: 17:05
 */

namespace App\Helpers;
use App\Connect\Mongodb;
use App\Chart\Chart;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Mixed_;


class GraficosHelper {
    /*
     * var array
     */
    private static $colors = [];


    public static function OperacionesMongo($collections,$dimension,$medida,$operacion){
        switch ($operacion){
            case 'SUM':   return Mongodb::getSum($collections,$dimension,$medida);
                          break;
            case 'COUNT': return Mongodb::getCount($collections,$dimension,$medida);
                          break;
            case  'AVG':  return Mongodb::getAvg($collections,$dimension,$medida);
                          break;
        }
    }

    public static function GenerateRandomColor(){
        $color = '#';
        $colorHexLighter = array("9","A","B","C","D","E","F" );
        for($x=0; $x < 6; $x++):
            $color .= $colorHexLighter[array_rand($colorHexLighter, 1)]  ;
        endfor;
        return substr($color, 0, 7);
    }

    public static function getGrafico(Array $data,string $type,$dimension, $medida, string $title , string $dataSetTitle,string $titleEjEY, string $titleEjeX){
         $chart = new Chart();
         $names = Arr::pluck($data, $dimension);
         $values = Arr::pluck($data, $medida);


         switch ($type){
                case 'bar':
                      return self::getBar($chart,$values,$names, self::getColor( count($values) ) ,$dataSetTitle,$title,$titleEjEY,$titleEjeX);
                      break;
                case 'line':
                       return self::getLine($chart,$values,$names, self::getColor(1) ,$dataSetTitle,$title,$titleEjEY,$titleEjeX);
                       break;
                case  'pie':
                       return self::getPie($chart,$values,$names,  self::getColor( count($values) ),$dataSetTitle,$title);
                       break;
         }

    }

    private static function getColor( int $n ): array {
        for ($x = 1 ; $x <= $n; $x++):
            self::$colors[] = self::GenerateRandomColor();
        endfor;
        return self::$colors;
    }

    private static function getLine(Chart $chart,Array $data, Array $labels , Array $colors, string $titleDataSet,string  $title, string $titleEjeY, string $titleEjeX){
            return $chart->name('lineChartTest')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labels)
                ->datasets([
                    [
                        "label" => $titleDataSet,
                        'backgroundColor' => $colors,
                        'borderColor' => $colors,
                        "pointBorderColor" => $colors,
                        "pointBackgroundColor" => $colors,
                        "pointHoverBackgroundColor" => $colors,
                        "pointHoverBorderColor" => $colors,
                        'data' => $data,
                        "fill" => false
                    ],
                ])
                ->options([
                    "responsive" => true,
                    "title" => ["display" => true, "text" => $title],
                    "tooltips" => ["mode" => "index","intersect" => false],
                    "hover" => ["mode" =>"nearest","intersect" => true],
                    "scales" => [
                        "xAxes" => [
                            ["display" => true,"scaleLabel" => ['display' => true, 'labelString' => $titleEjeX],]
                        ],
                        "yAxes" => [
                            [ "display" => true, "scaleLabel" => ['display' => true, 'labelString' => $titleEjeY],]
                        ]
                    ]
                ])
                ->renderJson();
    }

    private static function getBar(Chart $chart, array $data , array $labels , Array $colors, string $titleDataSet, string  $title, string $titleEjeY, string $titleEjeX){
        return $chart->name('barChartTest')
                     ->type('bar')
                     ->size(['width' => 400, 'height' => 200])
                     ->labels($labels)
                     ->datasets([
                             [
                               'label' => $titleDataSet,
                               'backgroundColor' => $colors,
                               'data' => $data,
                               'borderWidth' => 1
                             ]
                         ])
                     ->options([
                         "responsive" => true,
                         "title" => ["display" => true, "text" => $title],
                         "tooltips" => [ "mode" => "index", "intersect" => true],
                         "scales" => [
                             "xAxes" => [
                                 [
                                     "stacked" => true,
                                     "barPercentage" => 0.7,
                                     "gridLines" => [
                                         'display' => true,
                                         "drawOnChartArea" => true,
                                         "offsetGridLines" => true,
                                     ],
                                     "scaleLabel" => ['display' => true, 'labelString' => $titleEjeY]
                                 ]
                             ],
                             "yAxes" => [
                                [
                                   "ticks" => [  "min" => 0],
                                    "scaleLabel" => ['display' => true, 'labelString' => $titleEjeX]
                                ]
                             ]
                         ]
                     ])
                     ->renderJson();
    }

    private static function getPie(Chart $chart, array $data , array $labels , Array $colors, string $titleDataSet, string  $title){
        return $chart->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [   'label' => $titleDataSet,
                    'backgroundColor' => $colors,
                    'hoverBackgroundColor' => $colors,
                    'data' => $data
                ]
            ])
            ->options([
                "responsive" => true,
                "title" => ["display" => true,"text" =>$title],
            ])
            ->renderJson();
    }

}