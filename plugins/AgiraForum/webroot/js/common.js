var $dc = $(document);
function xload(flag)
{
    var so = (flag) ? ':not(.xltriggered)' : '';
    $('.btnSubmit'+so).each(function() {
        $(this).click(function(){
            $this = $(this);
            var id = $this.closest("form").find(".jsTextEditor").attr('id');
            $("#"+id).text($("#"+id).Editor('getText'));
            $("#"+id).Editor('setText','');
            $this.closest("form").submit();
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
    $('.jsTextEditor' + so).each(function(e) {
        html = $(this).text();  
        //editor = $(this).Editor();
        id = $(this).attr("id");
        $("#"+id).Editor({'fonts':false,'styles':false,'font_size':false,'undo':false, 'redo':false,'insert_link':false, 'unlink':false,  'insert_table':false,'print':false, 'rm_format':false, 'select_all':false, 'source':false,'togglescreen':false,'strikeout':false, 'hr_line':false, 'splchars':false,'height':'200px'});
        $("#"+id).Editor('setText',html);
        //$("#"+id).Editor({'advancedoptions':false});
        // $("#"+id).Editor({'textformats':false});
        // $("#"+id).Editor({'screeneffects':false});
        // $("#"+id).Editor({'extraeffects':false});
    }).addClass("xltriggered");
}
$dc.ready(function($) {
    xload(true);
}).ajaxStop(function() {
    xload(true);
});