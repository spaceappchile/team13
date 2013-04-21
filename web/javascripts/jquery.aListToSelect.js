/**
* Alvaro's List to Select
* This plugin aims to fill a gap when developing with Mobile First Aproach in mind
* Saving time converting list to select for mobile devices ;)
*
* Copyleft: Alvaro Veliz
* Licence: MIT
* Original Idea: Carlos Elias
*/

(function($){

  $.fn.aListToSelect = function( options ) {  

    var $this = this;
    var settings = $.extend( {
      'target' : '',
      'selectedClass' : 'selected',
      'hideList' : true
    }, options);

    return this.each(function() {  
      $select = $('<select class="select-main-menu">')
      
      if (settings.target != '')  {
        $select.appendTo($(settings.target));    
      }

      $this.children('li').each(function(e, elem){
        $li    = $(elem);
        $a     = $('a', elem);
        

        if ($li.children('ul').length > 0) {
          $optionGroup = $('<optgroup />').attr('label', $a.html());


          $li.children('ul').children('li').each(function(ge, gelem){
            $childA = $('a', gelem);
            $optionChild = $('<option>')
              .text($childA.text())
              .val($childA.attr('href'))                      
              .appendTo($optionGroup);                              
              
              if ($childA.hasClass( settings.selectedClass )) {
                $optionChild.attr('selected', 'selected');
              }
          });
          
          $optionGroup.appendTo($select);
        }
        else {
          $option = $('<option>')
            .text($a.text())
            .val($a.attr('href'))                      
            .appendTo($select);                            
          
          if ($a.hasClass( settings.selectedClass )) {
            $option.attr('selected', 'selected');
          }
        }
      });

      if (settings.hideList == true) {
        $this.hide();
      }
    });

  };
})( jQuery );