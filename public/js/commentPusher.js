var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('li.scrollable-container');


var channel = pusher.subscribe('channel-comments-notification');
channel.bind('comments-notification', function(data) {
    if(user_id == data.user_id)
    {
        var existingNotifications = notifications.html();
        var newNotificationHtml ='<a href="'+data.url+'"> <div class="media" style="direction: rtl;"><img src="'+ data.user_img +'" alt="" srcset="" class="rounded-circle ml-3" style="width:55px;"><div class="media-body"><h6 class="media-heading text-right ">'+ data.title +'</h6><p class="notification-text font-small-3 text-muted text-right">'+ data.content +'</p><small style="direction: ltr;"><p class=" text-muted text-right"style="direction: ltr;"> '+ data.created_at +'</p><br></small></div></div></a>';

        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();

        // append comment to comments
        var post = $('.post_' + data.post_id);
        var post_footer = post.find('div.card-footer');
        post_footer.append('<div class="card"><div class="card-body"><h4><img src="'+ data.user_img +'" alt="" srcset="" class="rounded-circle" style="width:55px;">'+ data.name + '</h4><p>'+ data.comment +'</p></div></div>');
    }
});


$(".comment_form").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "post",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           complete: function(){

           },
           success: function(data)
           {
                if(data.status == true)
                {
                    var result = data.data;
                    // console.log(result);
                    form.parent().append('<div class="card"><div class="card-body"><h4><img src="'+ result.user_img +'" alt="" srcset="" class="rounded-circle" style="width:55px;"> '+ result.name + '</h4><p>'+ result.comment +'</p></div></div>');
                    form[0].reset();
                }
                else{
                    console.log('there is an error happen');
                }
           }
         });


});
