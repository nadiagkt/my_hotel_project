(function ($) {
    $(document).on('submit', 'form.searchForm', function(e) {
        // stop default form behavior
        e.preventDefault(); 

        // get form data

        const formData = $(this).serialize();
        
        // ajax request
        $.ajax(
            'http://localhost/my_hotel_project/public/ajax/search_results.php',
            { 
                type: "GET", 
                dataType: "html",
                data: formData
            }).done(function(result) {
                //clear results
                $('#search-results-container').html('');

                //append results
                $('#search-results-container').append(result);

                //push url
                history.pushState({},'', 'http://localhost/my_hotel_project/public/list.php?' + formData);
            })
            
            
    })
})(jQuery)

