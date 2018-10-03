/**
 * @package     Joomla.Administrator
 * @subpackage  com_faq
 *
 * @copyright   Copyright (C) 2018 Nikolai N. Demin All rights reserved.
 * @license     MIT license: http://codemirror.net/LICENSE
 */

jQuery(document).ready(function () {
  jQuery('.FAQValue input[type="radio"]:checked').parent().addClass('isChecked');

  jQuery('.FAQValue label').click(function () {
    jQuery(this).parent().find('.isChecked').removeClass('isChecked');
    jQuery(this).parent().find('input:checked').prop( "checked", false );
    jQuery(this).addClass('isChecked');
    jQuery(this).find('input:checked').prop( "checked", true );
  })
});

