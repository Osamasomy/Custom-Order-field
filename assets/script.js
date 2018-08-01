jQuery(document).ready(function(){
   jQuery('#select_all').click(function(event) {
        if(this.checked) {
          // Iterate each checkbox
          jQuery(':checkbox').each(function() {
            this.checked = true;                        
          });
        }
        else {
          // Iterate each checkbox
          jQuery(':checkbox').each(function() {
            this.checked = false;
          });
        }
      });

});
