<?php
//This function was stolen from https://beamtic.com/reordering-arrays-php
function array_shove(array $array, $selected_key, $direction)
{
    $new_array = array();
    if ($selected_key == 0){
      return $array;
    }
    foreach ($array as $key => $value) {
        if ($key !== $selected_key) {
            $new_array["$key"] = $value;
            $last = array('key' => $key, 'value' => $value);
            unset($array["$key"]);
        } else {
            if ($direction !== 'up') {
                // Value of next, moves pointer
                $next_value = next($array);

                // Key of next
                $next_key = key($array);

                // Check if $next_key is null,
                // indicating there is no more elements in the array
                if ($next_key !== null) {
                    // Add -next- to $new_array, keeping -current- in $array
                    $new_array["$next_key"] = $next_value;
                    unset($array["$next_key"]);
                }
            } else {
                if (isset($last['key'])) {
                    unset($new_array["{$last['key']}"]);
                }
                // Add current $array element to $new_array
                $new_array["$key"] = $value;
                // Re-add $last to $new_array
                $new_array["{$last['key']}"] = $last['value'];
            }
            // Merge new and old array
            return $new_array + $array;
        }
    }
}
?>
