<?php

class CoreController{

    static public function generateInput_x($name, $label, $type, $placeholder, $value='', $pattern='', $required='', $id='', $readonly='', $class=''){
        return <<<INPUT
        <div class="form-group row">
            <label for="{$name}" class="col-sm-5 col-form-label"><strong>{$label}</strong></label>
            <div class="col-sm-7">
                <input type="{$type}" class="form-control {$class}" id="{$id}" name="{$name}" placeholder="{$placeholder}" value="{$value}" pattern="{$pattern}" {$required} {$readonly}>
            </div>
        </div>
        INPUT;
    }

    static public function number($name, $label, $placeholder, $value='', $pattern='', $required='', $min='', $max='', $id='', $readonly=''){
        return <<<INPUT
        <div class="form-group row">
            <label for="{$name}" class="col-sm-5 col-form-label"><strong>{$label}</strong></label>
            <div class="col-sm-7">
                <input type="number" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}" value="{$value} min="{$min}" max="{$max}" pattern="{$pattern}" {$required} {$readonly}>
            </div>
        </div>
        INPUT;
    }

}