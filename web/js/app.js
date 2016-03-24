$(document).ready(function() {
    
   $("#add-link").click(function(event) {
       $("#form-link").css({
            display: 'block'
        });
   });
   $("#get-archived").click(function(event){
        if($(this).attr('data-archived') == "false")
    {
        $(this).html("Non Archived")
        $(this).attr('data-archived',true);
    }
    else if ($(this).attr('data-archived') == "true")
    {
        $(this).html("Archived");
        $(this).attr('data-archived',false);
    }
    var isArchived = $(this).attr('data-archived');

    $.ajax({
        type: "POST",
        url: "/archived",
        data: {
           archived: isArchived
        },
        success: function(response) {
            $('#articles').html(response);
        }
    });

   });

   $('body').on("click", ".delete-article", function(event) {
        var articleUrl = $(this).data('article');
        $.ajax({
        type: "POST",
        url: "/link/delete",
        data: {
           url: articleUrl
        },
        success: function(response) {
            $('#articles').html(response);
        }
    });
   });

   $('body').on("click", ".archive-article", function(event) {
        var articleUrl = $(this).data('article');
        var isArchived = $("#get-archived").attr('data-archived');
        $.ajax({
        type: "POST",
        url: "/link/archive",
        data: {
           url: articleUrl,
           archived: isArchived
        },
        success: function(response) {
            $('#articles').html(response);
        }
    });
   });

   var currentUrlForTag = "";
   $('body').on("click", ".fa-tags", function(event){
    $("#popup-category").css({
      'visibility': 'visible',
  'opacity': 1,
  'z-index': 10
    });
    currentUrlForTag = $(this).data('article');
   });

   $('.category-popup').click(function(event) {
     var category = $(this).data('category');
     $("#popup-category").css({
      'visibility': 'hidden',
  'opacity': 0,
  'z-index': -10
    });
     $.ajax({
        type: "POST",
        url: "/link/category",
        data: {
           url: currentUrlForTag,
           category: category
        },
        success: function(response) {
            $('#articles').html(response);
        }
    });
   });
});
