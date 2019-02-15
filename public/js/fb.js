$(function(){
    $(".show-button").click(function(){
        var $this = $(this);
        var $target = $this.next();
        if($target.css('display') == 'none'){
            $target.slideDown(400);
        
        }else{
            $target.slideUp(400);

        };
    });
});