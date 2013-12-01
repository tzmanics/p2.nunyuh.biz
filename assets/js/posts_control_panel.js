$('#refresh-button').click(function() {

    $.ajax({
        type: 'POST',
        url: '/posts/p_control_panel',
        success: function(response) { 

            // For debugging purposes
            // console.log(response);

            // Example response: {"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}

            // Parse the JSON results into an array
            var data = $.parseJSON(response);

            // Inject the data into the page
            $('#post_count').html(data['post_count']);
            $('#user_count').html(data['user_count']);
            $('#most_recent_post').html(data['most_recent_post']);

        },
    });
});