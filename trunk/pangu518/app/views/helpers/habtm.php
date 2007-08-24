<?php 
class HabtmHelper extends HtmlHelper { 
     
    /** 
     * Returns a list of checkboxes. 
     * 
     * @param string $fieldName Name attribute of the SELECT 
     * @param array $options Array of the elements (as 'value'=>'Text' pairs) 
     * @param array $selected Selected checkboxes 
     * @param string $inbetween String that separates the checkboxes. 
     * @param array $htmlAttributes Array of HTML options 
     * @param  boolean $return         Whether this method should return a value 
     * @return string List of checkboxes 
     */ 
    function checkboxMultiple($fieldName, $options, $selected = null, $inbetween = null, $htmlAttributes = null, $return = false) { 
        $this->setFormTag($fieldName); 
        if ($this->tagIsInvalid($this->model, $this->field)) { 
            if (isset($htmlAttributes['class']) && trim($htmlAttributes['class']) != "") { 
                $htmlAttributes['class'] .= ' form_error'; 
            } else { 
                $htmlAttributes['class'] = 'form_error'; 
            } 
        } 
        if (!is_array($options)) { 
            return null; 
        }     
        if (!isset($selected)) { 
            $selected = $this->tagValue($fieldName); 
        } 
        foreach($options as $name => $title) { 
            $optionsHere = $htmlAttributes; 
            if (($selected !== null) && ($selected == $name)) { 
                $optionsHere['checked'] = 'checked'; 
            } else if (is_array($selected) && array_key_exists($name, $selected)) { 
                $optionsHere['checked'] = 'checked'; 
            } 
            $optionsHere['value'] = $name; 
            $checkbox[] =  sprintf($this->tags['checkboxmultiple'], $this->model, $this->field, $this->parseHtmlOptions($optionsHere), $title) ."<br/>"; 
        } 
        return "\n" . sprintf($this->tags['hiddenmultiple'], $this->model, $this->field, null, $title) .  $this->output(implode($checkbox), $return) ; 
    } 
     
} 
?>