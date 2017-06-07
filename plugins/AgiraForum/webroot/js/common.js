var $dc = $(document);
function xload(flag)
{
    var so = (flag) ? ':not(.xltriggered)' : '';
    $('.btnSubmit'+so).each(function() {
        $(this).click(function(){
            $this = $(this);
            var id = $this.closest("form").find(".jsTextEditor").attr('id');
            var text = $("#"+id).Editor('getText');
            if(text != '')
            {
                $("#"+id).text(text);
                $("#"+id).Editor('setText','');
                $this.closest("form").find(".jsTextEditor").closest(".textarea").find(".error").remove();
                $this.closest("form").submit();

            }
            else
            {
                $this.closest("form").find(".jsTextEditor").closest(".textarea").append("<div class='error text-danger'>This field cannot be left empty</div>");
            }
        });
    }).addClass("xltriggered");
    $('.btnCommentCancel'+so).each(function() {
        $(this).click(function(){
            $this = $(this);
            id = $this.data('id');
            $.ajax({
                url: "/forum/posts/preview/"+id,
            }).done(function(data) {
               $this.closest(".clsForumPost").html(data);
            });
            return false;
        });
    }).addClass("xltriggered");
    $('.ajaxForm'+so).each(function() {
        $this = $(this);
        $(this).ajaxForm(function(response) {
           var data = response.split("*");
           if(data[0] == 'new')
           {
                $('.jsForumPostContents').append('<div class="clearfix clsForumPost">'+data[1]+'</div><hr>');
                //$('.jsForumPostContents .clsForumPost').last().scrollTop();
                $("html,body").animate({scrollTop: $('.jsForumPostContents .clsForumPost').last().offset().top - 30});
           }
           else
           {
                $this.closest('.clsForumPost').html(data[1]);
           }
        });
    }).addClass("xltriggered");
    $('.jsEditPost' + so).each(function(e) {
        $(this).click(function(){
            var postid = $(this).data('postid');
            var forumid = $(this).data('forumid');
            $.ajax({
                type: 'GET',
                url: '/forum/posts/edit/'+forumid+"/"+postid,
                cache: false,
                success: function(data) {
                    $('.clsForumPost-'+postid).html(data);
                }
            });
            return false;
        });
    }).addClass("xltriggered");
    $('.jsQuotePost' + so).each(function(e) {
        $(this).click(function(){
            var postid = $(this).data('postid');
            var text = $(".jsCommentContent-"+postid).html();
            var user = "<a href='#Comment-"+postid+"'>@"+$(".jsCommentContentUser-"+postid).html()+"</a>";
            var content = "<blockquote>"+user+" said: <br>"+text+"</blockquote><br>";
            $("#postdata").Editor('setText',content);
            $("html,body").animate({scrollTop: $('.clsPostCommentBlock').offset().top - 30});
            return false;
        });
    }).addClass("xltriggered");
    $('.jsLikePost' + so).each(function(e) {
        $(this).click(function(){
            var postid = $(this).data('postid');
            $this = $(this);
            $.ajax({
                url: "/forum/posts/like/"+postid,
            }).done(function(data) {
                if(data == "liked")
                {
                    $this.html("<i class='fa fa-thumbs-up'></i> Liked");
                }
                else if(data == "unliked")
                {   
                    $this.html("<i class='fa fa-thumbs-o-up'></i> Like");
                }
            });
            return false;
        });
    }).addClass("xltriggered");
    $('.jsCloseDiscussion' + so).each(function(e) {
        $(this).click(function(){
            var slug = $(this).data('slug');
            alert(slug);
            $this = $(this);
            $.ajax({
                url: "/forum/posts/close/"+slug,
            }).done(function(data) {
                window.location.reload()
            });
            return false;
        });
    }).addClass("xltriggered");
    
    $('.jsTextEditor' + so).each(function(e) {
        html = $(this).text();  
        //editor = $(this).Editor();
        id = $(this).attr("id");
        $("#"+id).Editor({'undo':false, 'redo':false,
            'insert_img':false, 'insert_table':false,'print':false, 'rm_format':false, 'select_all':false, 'source':false,'togglescreen':false,'strikeout':false, 'hr_line':false, 'splchars':false,'block_quote':false});
        $("#"+id).Editor('setText',html);
        //$("#"+id).Editor({'advancedoptions':false});
        // $("#"+id).Editor({'textformats':false});
        // $("#"+id).Editor({'screeneffects':false});
        // $("#"+id).Editor({'extraeffects':false});
    }).addClass("xltriggered");
}
$dc.ready(function($) {
    xload(true);
    if($(window.location.hash).length > 0)
    {
        $("html,body").animate({scrollTop: $(window.location.hash).offset().top - 30});
    }
}).ajaxStop(function() {
    xload(true);
});