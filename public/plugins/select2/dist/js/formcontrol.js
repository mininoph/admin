(function($) {
    'use strict';
    
      $(document).ready(function()
        {  
            console.log("---"+$('#cvr').length); 
            console.log("checkkkkkk"); 
                $('#cvr').hide();
                //  $("body").css("cvr", "hidden");
    
                if ($('#cvr').length) {
                             console.log("ss"); 
    
                }else{
                     console.log("no"); 
                     alert('no ');
                }

            });
        
    
    

})(jQuery);