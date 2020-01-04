<?php
  /*
   * This file manages functions related to ACF validations.
   */

  /**
   * Validates that ACF link fields don't exceed character limits
   *
   * @param {Mixed} $valid - Whether or not the value is valid (true / false).
   *                         Can also be returned as a custom error message (string)
   * @param {Mixed} $value - The value to be saved
   * @param {Array} $field - An array containing all the field settings
   * @param {String} $input - the DOM element’s name attribute
   * @return {Mixed} Whether or not the value is valid (true / false). Can also be returned
   *                 as a custom error message (string)
   */
  function cl_validate_link_length( $valid, $value, $field, $input ) {
    /* if already invalid, return that error */
    if ( ! $valid ) {
      return $valid;
    }

    /* Ensure the field has a maxlength set and greater than 0 */
    if ( array_key_exists( 'maxlength', $field ) && intval( $field['maxlength'] ) > 0 ) {
      $link_length = strlen( $value['title'] );

      /* return error if link title is greater than max length parameter */
      if ( $link_length > intval( $field['maxlength'] ) ) {

        /* if instructions exist in the field, use those, otherwise use the chartacter limit */
        if ( array_key_exists( 'instructions', $field ) && '' != $field['instructions'] ) {
          $valid = $field['instructions'];
        } else {
          $valid = 'Link text must be ' . $field['maxlength'] . ' characters or less';
        }
      }
    }

    return $valid;
  }

  add_filter( 'acf/validate_value/key=FIELDKEY', 'we_validate_link_length', 10, 4 );
