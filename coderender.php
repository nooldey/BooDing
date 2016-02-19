<?php
/*
Template Name: coderender
*/
?> 
<?php get_header(); ?>
<style>
	.entry section {
	    padding: 10px;
            text-indent: 0;
	    border: 1px solid #666;
	    border-top: 4px solid #666;
	    margin: 10px auto;
    }
    hr{
    	margin:3px auto;
    	color:#666;
    	}
    button {
		background: #08B;
		color: white;
		border: 0;
		padding: 3px;
		width: 80px;
		cursor: pointer;
		margin-left: 5px;
	}
</style>
<div id="wrapper">
    <div id="content">
        <article class="post post-page"  id="post-<?php the_ID(); ?>">
            <header class="page-title">
                <h2><?php the_title(); ?></h2>
                <address class="page-edit">
                    <span class  ="entry-views"><?php if(function_exists('post_views')){ post_views('浏览','次'); } ?></span>
                    <span ><?php edit_post_link(__('[编辑]', 'zws'), '<p>', '</p>'); ?></span>
                </address>
            </header>
            <div class="entry">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                     <?php the_content(); ?>
                <?php endwhile;endif; ?>
                <p>
                    本工具支持 java . xml . sql . jscript . groovy . css . cpp . c# . python . vb . perl . php . ruby . delphi 代码高亮标记。</p>
                    <p>使用前请添加<FONT color="blue">&lt;link href="highlight.css" rel="Stylesheet" type="text/css"/&gt;</FONT> 到您的html文件，并下载<FONT color="blue">hightlight.css</FONT>文件到您的目录下。</p>
                    <p>提示：复制粘贴<u>HTML代码</u>请用Ctrl+C和Ctrl+V，代码过长用鼠标双击或Ctrl+A全选。</p>
            
                <section>
                    <h3>输入源代码</h3>
                    <TEXTAREA title="Input source code here." class="java" id="sourceCode" style="WIDTH: 100%" name="sourceCode" rows="6"></TEXTAREA>
                </section>
                <div class="clear"></div>
                <section>
                    <h3>转换设置</h3>
                    <hr>
                    <TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
                        <TBODY>
                            <TR>
                                <TD>代码类型:</TD>
                                <TD>
                                    <SELECT onchange="document.getElementById('sourceCode').className=this.value">
                                        <OPTION value="java selected">java</OPTION>
                                        <OPTION value="xml">xml</OPTION>
                                        <OPTION value="sql">sql</OPTION>
                                        <OPTION value="jscript">jscript</OPTION>
                                        <OPTION value="groovy">groovy</OPTION>
                                        <OPTION value="css">css</OPTION>
                                        <OPTION value="cpp">cpp</OPTION>
                                        <OPTION value="c#">c#</OPTION>
                                        <OPTION value="python">python</OPTION>
                                        <OPTION value="vb">vb</OPTION>
                                        <OPTION value="perl">perl</OPTION>
                                        <OPTION value="php">php</OPTION>
                                        <OPTION value="ruby">ruby</OPTION>
                                        <OPTION value="delphi">delphi</OPTION>
                                    </SELECT>
                                </TD>
                                <TD>设置: </TD>
                                <TD>
                                    <INPUT id="showGutter" type=checkbox CHECKED>行号 
                                    <INPUT id="showControls" type=checkbox >控制条 
                                    <INPUT id="firstLine" type=checkbox CHECKED>首行为1 
                                    <INPUT id="collapseAll" type=checkbox>折叠 
                                    <INPUT id="showColumns" type=checkbox>标尺 
                                </TD>
                                <TD>
                                    <button onclick="generateCode()">转换</button>
                                    <button onclick="clearText()">清除</button>
                                </TD>
                            </TR>
                        </TBODY>
                    </TABLE>
                </section>
                <div class="clear"></div>
                <section>
                    <h3>HTML 代码（输出）</h3>
                    <TEXTAREA id="htmlCode" style="WIDTH: 100%" name="htmlCode" id="htmlCode" rows="6"></TEXTAREA>
                </section>
                <div class="clear"></div>
                <section>
                    <h3>HTML 预览</h3>
                    <hr>
                    <DIV id="preview" style="color:black;Z-INDEX: 1; OVERFLOW: auto; WIDTH: 100%; HEIGHT: 100px" name="preview"></DIV>
                </section>
            </div>
        </article>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/js/shCore.js" charset="utf-8" type="text/javascript"></script>
<SCRIPT charset="utf-8">

    window.resizeTo(750,532);

    function clearText()
    {
        document.getElementById("sourceCode").value="";
        document.getElementById("htmlCode").value="";
        document.getElementById("preview").innerHTML="";
    }

    function generateCode()
    {
    
        if(document.getElementById("sourceCode").value.trim()=="")
        {
            return;
        }
        
        dp.SyntaxHighlighter.HighlightAll("sourceCode",
        document.getElementById("showGutter").checked,
        document.getElementById("showControls").checked,
        document.getElementById("collapseAll").checked,
        document.getElementById("firstLine").checked,
        document.getElementById("showColumns").checked);
    }

    function docopy(src)
    {
        if(src=='source')
        {
            if(document.getElementById("sourceCode").value != "")
                window.clipboardData.setdata("Text",document.getElementById("sourceCode").value); 
            else
                alert("Content is empty, can't copy!")
        }
        else if(src=='html')
        {
            if(document.getElementById("htmlCode").value != "")
                window.clipboardData.setdata("Text",document.getElementById("htmlCode").value); 
            else
                alert("Content is empty, can't copy!")
        }
        else
        {
            if(document.getElementById("preview").innerHTML != "")
                window.clipboardData.setdata("Text",document.getElementById("htmlCode").value);
            else
                alert("Content is empty, can't copy!")
        }
    }

    function dopasted(dst)
    {
        if(dst == 'source')
        {
            if(window.clipboardData.getdata("Text") != null)
                document.getElementById("sourceCode").value=window.clipboardData.getdata("Text"); 
        }
        else if(dst == 'html')
        {
            if(window.clipboardData.getdata("Text") != null)
                document.getElementById("htmlCode").value=window.clipboardData.getdata("Text"); 
        }
        else
        {
            if(window.clipboardData.getdata("Text") != null)
                document.getElementById("preview").innerHTML=window.clipboardData.getdata("Text"); 
        }
    }

    function doclear(dst)
    {
        if(dst == 'source')
        {
            document.getElementById("sourceCode").value=""; 
        }
        else if(dst == 'html')
        {
            document.getElementById("htmlCode").value=""; 
        }
        else
        {
            document.getElementById("preview").innerHTML=""; 
        }
    }

    String.prototype.trim = function(){
        return this.replace(/(^\s*)|(\s*＄)/g, "");
    }

//rendered div - highlighted div
var  highlightdiv = null;

// highlightes all elements identified by name and gets source code from specified property
dp.sh.HighlightAll = function(name, showGutter /* optional */, showControls /* optional */, collapseAll /* optional */, firstLine /* optional */, showColumns /* optional */)
{
    function FindValue()
    {
        var a = arguments;
        
        for(var i = 0; i < a.length; i++)
        {
            if(a[i] == null)
                continue;
                
            if(typeof(a[i]) == 'string' && a[i] != '')
                return a[i] + '';
        
            if(typeof(a[i]) == 'object' && a[i].value != '')
                return a[i].value + '';
        }
        
        return null;
    }
    
    function IsoptionSet(value, list)
    {
        for(var i = 0; i < list.length; i++)
            if(list[i] == value)
                return true;
        
        return false;
    }
    
    function GetoptionValue(name, list, defaultValue)
    {
        var regex = new RegExp('^' + name + '\\[(\\w+)\\]＄', 'gi');
        var matches = null;

        for(var i = 0; i < list.length; i++)
            if((matches = regex.exec(list[i])) != null)
                return matches[1];
        
        return defaultValue;
    }

    var elements = document.getElementsByName(name);
    var highlighter = null;
    var registered = new Object();
    var propertyName = 'value';
    
    // if no code blocks found, leave
    if(elements == null)
        return;

    // register all brushes
    for(var brush in dp.sh.Brushes)
    {
        var aliases = dp.sh.Brushes[brush].Aliases;

        if(aliases == null)
            continue;
        
        for(var i = 0; i < aliases.length; i++)
            registered[aliases[i]] = brush;
    }

    for(var i = 0; i < elements.length; i++)
    {
        var element = elements[i];
        var options = FindValue(
                element.attributes['class'], element.className, 
                element.attributes['language'], element.language
                );
        var language = '';
        
        if(options == null)
            continue;
        
        options = options.split(':');
        
        language = options[0].toLowerCase();

        if(registered[language] == null)
            continue;
        
        // instantiate a brush
        highlighter = new dp.sh.Brushes[registered[language]]();
        
        // hide the original element
        //element.style.display = 'none';

        highlighter.noGutter = (showGutter == null) ? IsoptionSet('nogutter', options) : !showGutter;
        highlighter.addControls = (showControls == null) ? !IsoptionSet('nocontrols', options) : showControls;
        highlighter.collapse = (collapseAll == null) ? IsoptionSet('collapse', options) : collapseAll;
        highlighter.showColumns = (showColumns == null) ? IsoptionSet('showcolumns', options) : showColumns;
        
        // first line idea comes from Andrew Collington, thanks!
        highlighter.firstLine = (firstLine == null) ? parseInt(GetoptionValue('firstline', options, 1)) : firstLine;

        highlighter.Highlight(element[propertyName]);
        
        document.getElementById("htmlCode").value = highlighter.div.outerHTML.substring();/*此处已去掉括号内数字2,似乎数字2会导致输出吞噬掉2个字符*/

        highlightdiv = highlighter;
        
        document.getElementById("preview").innerHTML = highlighter.div.outerHTML.trim();
    }   
}

// executes toolbar command by name
dp.sh.Toolbar.Command = function(name, sender)
{
    var n = sender;
    
    //while(n != null && n.className.indexOf('dp-highlighter') == -1)
    //  n = n.parentNode;
    //if(n != null)
        dp.sh.Toolbar.Commands[name].func(sender, highlightdiv);
}

</SCRIPT>