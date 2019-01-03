$(function () {
    
    $original = $('.user-input').clone(true);
    
    function DuplicateForm () {
        var newForm;
        
        duplicates++; 

        newForm = $original.clone(true).insertBefore($('.add'));
        
        $.each($('input', newForm), function(i, item) {            
            $(item).attr('name', $(item).attr('name') + duplicates);
        });
    }
    
    $('.add').on('click', function (e){
        e.preventDefault();
        DuplicateForm();
    });
});