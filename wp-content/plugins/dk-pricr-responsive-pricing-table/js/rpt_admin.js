$j=jQuery.noConflict();
$j(document).ready(function (){
  
    $j('.rpt_font_sett').hide();
    
    $j("#rpt_font_sett_button").click(function(){
        $j('.rpt_font_sett').slideToggle();
    });
      
    
});