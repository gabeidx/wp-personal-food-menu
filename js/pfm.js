;(function($, window, undefined){
    if (!$.length) return;

    $(document).ready(function(){
        $('#pfm-list').on('click', '.delete-tag', function(e){
            if (confirm($(this).data('message')))
                return true;

            e.preventDefault()
            return false;
        })
    })
})(jQuery, this);