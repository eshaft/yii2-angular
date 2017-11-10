$(document).ready(function(){
    $(document).on('pjax:complete', function() {
        console.log('complete');
        $('form').each(function(){
            this.reset();
        });
    })
})