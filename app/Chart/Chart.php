<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 6/3/2019
 * Time: 12:39
 */

namespace App\Chart;


use Carbon\Carbon;

/**
 * Class Chart
 * @package App\Chart
 */
class Chart {

    /**
     * @var array
     */
    private $charts = [];

    private  $hour;


    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $defaults = [
        'datasets' => [],
        'labels'   => [],
        'type'     => 'line',
        'options'  => [],
        'size'     => ['width' => null, 'height' => null]
    ];

    /**
     * @var array
     */
    private $types = [
        'bar',
        'horizontalBar',
        'bubble',
        'scatter',
        'doughnut',
        'line',
        'pie',
        'polarArea',
        'radar'
    ];

    public function __construct(){
        $this->hour = Carbon::now()->format('d-m-y h:i:s');
    }

    /**
     * @return string
     */
    public function getHour(): string
    {
        return $this->hour;
    }

    /**
     * @param string $hour
     */
    public function setHour(string $hour): void
    {
        $this->hour = $hour;
    }


    /**
     * @param $name
     *
     * @return $this|Chart
     */
    public function name($name)
    {
        $this->name          = $name;
        $this->charts[$name] = $this->defaults;
        return $this;
    }

    /**
     * @param $element
     *
     * @return Chart
     */
    public function element($element)
    {
        return $this->set('element', $element);
    }

    /**
     * @param array $labels
     *
     * @return Chart
     */
    public function labels(array $labels)
    {
        return $this->set('labels', $labels);
    }

    /**
     * @param array $datasets
     *
     * @return Chart
     */
    public function datasets(array $datasets)
    {
        return $this->set('datasets', $datasets);
    }

    /**
     * @param $type
     *
     * @return Chart
     */
    public function type($type)
    {
        if (!in_array($type, $this->types)) {
            throw new \InvalidArgumentException('Invalid Chart type.');
        }
        return $this->set('type', $type);
    }

    /**
     * @param array $size
     *
     * @return Chart
     */
    public function size($size)
    {
        return $this->set('size', $size);
    }

    /**
     * @param array $options
     *
     * @return $this|Chart
     */
    public function options(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('options.' . $key, $value);
        }

        return $this;
    }

    /**
     *
     * @param string|array $optionsRaw
     * @return \self
     */
    public function optionsRaw($optionsRaw)
    {
        if (is_array($optionsRaw)) {
            $this->set('optionsRaw', json_encode($optionsRaw, true));
            return $this;
        }

        $this->set('optionsRaw', $optionsRaw);
        return $this;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $chart = $this->charts[$this->name];

        return view('chart-template::chart-template')
            ->with('datasets', $chart['datasets'])
            ->with('element', $this->name)
            ->with('labels', $chart['labels'])
            ->with('options', isset($chart['options']) ? $chart['options'] : '')
            ->with('optionsRaw', isset($chart['optionsRaw']) ? $chart['optionsRaw'] : '')
            ->with('type', $chart['type'])
            ->with('size', $chart['size']);
    }

    /**
     * @return  string
     */
    public function renderJson(){
        $chart = $this->charts[$this->name];
        return json_encode([
            'element' => $this->name,
            'datasets' => $chart['datasets'] ,
            'labels' => $chart['labels'],
            'options'  => isset($chart['options']) ? $chart['options'] : '',
            'optionsRaw' =>  isset($chart['optionsRaw']) ? $chart['optionsRaw'] : '',
            'type' => $chart['type'],
            'size' => $chart['size'],
            'hour' => $this->getHour()
        ] );
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    private function get($key)
    {
        return array_get($this->charts[$this->name], $key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this|Chart
     */
    private function set($key, $value)
    {
        array_set($this->charts[$this->name], $key, $value);
        return $this;
    }

}