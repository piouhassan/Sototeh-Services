<?php
/**
 * Created by PhpStorm.
 * User: Tanza Studio
 * Date: 19/11/2018
 * Time: 10:02
 */

namespace App\Views\Extensions;


use DateTime;
use Twig_Extension;

class FormExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions() : array
    {
    return [
        new \Twig_SimpleFunction('field', [$this, 'field'],
            ['is_safe' => ['html'],
                "needs_context"  => true
            ])
        ];
   }

    /**
     * @param array $context
     * @param string $key
     * @param $value
     * @param null|string $label
     * @param array $options
     * @param string $formtype
     * @return string
     */
    public function field(array $context, string $key, $value, ?string $label = null, array  $options = [], string $formtype = "text" ) : string
    {

        $type  =$options['type'] ?? 'text';
        $error = $this->getErrorHtml($context, $key);
        $class = 'form-group';
        $value = $this->convertValue($value);
         $attributes = [
           'class' => 'form-control',
             'name' => $key ,
           'id' => $key

         ];

        if ($error){
            $class .= " has-danger";
            $attributes['class'] .= ' form-control-danger';
        }

        if ($type === 'textarea'){
            $input = $this->textarea($value,$attributes);
        }elseif ($type === 'file'){
            $input = $this->file($attributes);
        }
        else{
            $input = $this->input($formtype, $value,$attributes);
        }
         return "   <div class=\"".$class."\">
                        <label for='{$key}'>{$label}</label>
                        {$input}
                        {$error}
                  </div>";
   }

    private function getErrorHtml($context, $key)
    {
        $error =$context['errors'][$key] ?? false;
        if ($error){
            return "<small class='form-text text-muted'>{$error}</small>";
        }
    return "";
   }

    /**
     * @param null|string $formtype
     * @param null|string $value
     * @param array $attributes
     * @return string
     */
    private function input(?string  $formtype , ?string $value, array $attributes) : string
    {
        return " <input type=\"{$formtype}\"  value=\"{$value}\" ".$this->getHtmlFromArray($attributes)." >
";
    }

    private function file($attributes)
    {
        return " <input type=\"file\"   ".$this->getHtmlFromArray($attributes)." >
";
    }

    /**
     * @param null|string $value
     * @param array $attributes
     * @return string
     */
    private function textarea( ?string $value, array $attributes) : string
    {
        return "
        <textarea   ".$this->getHtmlFromArray($attributes).">{$value}</textarea>
        ";
    }

    private function getHtmlFromArray(array $attributes)
    {
        return implode(' ', array_map(function ($key, $value){
            return "$key =\"$value\"";
        }, array_keys($attributes), $attributes));
    }

    private function convertValue($value)
    {
        if ($value instanceof  DateTime ){
            return $value->format('Y-m-d H:i:s');
        }
        return (string)$value;
    }



}