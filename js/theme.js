/*
 * nav menu
 * in header
 */ 
    jQuery(document).ready(function(jQuery) {
        jQuery('#nav ul li').hover(function() {
            jQuery('ul', this).slideDown(10)
            jQuery('ul', this).css("background-color", "#52b8cb")
        },
        function() {
            jQuery('ul', this).slideUp(10)
        })
    });
/*
 * go to top
 * for footer
 */

    jQuery(document).ready(function() {
    jQuery('.gototop').click(function(){jQuery('html,body').animate({scrollTop:'0px'},800);});
    });
/*
 * 标题——加载中...
 */
 //加载效果

    jQuery(document).ready(function(){
    jQuery('.post-title h2 a').click(function(){
        jQuery(this).text('努力加载中...');
        window.location = jQuery(this).attr('href');
        });
    });
/*tooltip*/
jQuery(function() {
    jQuery("a,button").each(function(b) {//这里是控制标签
        if (this.title) {
            var c = this.title;
            var a = -50;
            var h = 35;
            jQuery(this).mouseover(function(d) {
                this.title = "";
                jQuery("body").append('<div id="tooltip"><div id="tooltip-arrow"></div><div id="tooltip-inner">' + c + "</div></div>");
                jQuery("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: (d.pageY + h ) + "px",
                    opacity: "0.8"
                }).show(250)
            }).mouseout(function() {
                this.title = c;
                jQuery("#tooltip").remove()
            }).mousemove(function(d) {
                jQuery("#tooltip").css({
                    left: (d.pageX + a) + "px",
                    top: (d.pageY + h ) + "px"
                })
            })
        }
    })
});

/*评论分页ajax*/
jQuery(document).ready(function($) {
    $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');//commentnav ajax
    $(document).on('click', '.commentnav a', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            beforeSend: function() {
                $('.commentnav').remove();
                $('.commentlist').remove();
                $('#loading-comments').slideDown();
            },
            dataType: "html",
            success: function(out) {
                result = $(out).find('.commentlist');
                nextlink = $(out).find('.commentnav');
                $('#loading-comments').slideUp(550);
                $('#loading-comments').after(result.fadeIn(800));
                $('.commentlist').after(nextlink);

            }
        });
    });    
});

/*
//屏蔽鼠标右键、ALT翻页、CTRL+N、CTRL+R、F2~F11、SHIFT+左键
jQuery(document).ready(function($){
    $(document).bind("contextmenu",function(){return false;});  
    $(document).bind("selectstart",function(){return false;});  
    $(document).keydown(function(){return key(arguments[0])});   
    function key(e){
        var keyCode;
        if(window.event) //IE
        {
            keyCode = e.keyCode;
        }
        else if(e.which) //firefox/opera/chrome/netscape
        {
            keyCode = e.which;
        }
        if(
    (keyCode==112)||       //F2
    (keyCode==113)||       //F2
    (keyCode==114)||       //F3
    (keyCode==115)||       //F4
 // (keyCode==116)||       //F5
    (keyCode==117)||       //F6
    (keyCode==118)||       //F7
    (keyCode==119)||       //F8
    (keyCode==120)||       //F9
    (keyCode==121)||       //F10
 // (keyCode==122)||       //F11
    (keyCode==123)||       //F12
    (keyCode==17)||        //CTRL
    (keyCode==16)          //shift
    //此处填写后续条件
    ){
 //  alert("别再按了，你节操碎了！");     
    return false;    
    }
}
});
*/