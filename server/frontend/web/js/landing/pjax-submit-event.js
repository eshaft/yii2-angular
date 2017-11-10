$(document).ready(function(){
    $(document).on('pjax:complete', function() {
        console.log('complete');
        $('.landing-form').hide();
        $('.submit-success').show();
        $('form').each(function(){
            this.reset();
        });
    })
});