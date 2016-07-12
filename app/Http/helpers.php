<?php

  // If there is an error for this field, the style is changed to red
  function hasErrorForClass($errors, $column) {
    if(count($errors)) {
      if ($errors->has($column)) {
        return 'has-error';
      }
    }
  }

  // If there is an error for this field, display the error message
  function hasErrorForField($errors, $column) {
    if(count($errors)) {
      if ($errors->has($column)) {
        print '<span class="help-block">' . $errors->first($column) . '</span>';
      }
    }
  }
